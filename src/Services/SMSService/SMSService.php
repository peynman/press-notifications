<?php


namespace Larapress\Notifications\Services\SMSService;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Larapress\CRUD\BaseFlags;
use Larapress\ECommerce\Models\Cart;
use Larapress\Notifications\Models\SMSGatewayData;
use Larapress\Notifications\Models\SMSMessage;
use Larapress\Notifications\Services\SMSService\Jobs\BatchSendSMS;
use Larapress\Profiles\Models\Domain;
use Larapress\Profiles\Models\PhoneNumber;
use Larapress\Profiles\IProfileUser;
use Larapress\CRUD\Services\CRUD\ICRUDService;

class SMSService implements ISMSService
{
    /**
     * Find an appropriate gateway data based on domain
     *
     * @param Larapress\Profiles\Models\Domain $domain
     * @return SMSGatewayData
     */
    public function findGatewayData(Domain $domain)
    {
        $gateways = SMSGatewayData::query()
            ->whereRaw(DB::raw('(sms_gateways.flags & ' . SMSGatewayData::FLAGS_DISABLED . ') = 0'))
            ->get();

        foreach ($gateways as $gateway) {
            if (isset($gateway->data['disable_in_domains'])) {
                if (in_array($domain->id, $gateway->data['disable_in_domains'])) {
                    foreach ($gateway->data['enable_in_domains'] as $domainId => $status) {
                        if ($status && $domainId == $domain->id) {
                            continue; // move to next gateway
                        }
                    }
                }
            }
            if (isset($gateway->data['enable_in_domains']) && count($gateway->data['enable_in_domains']) > 0) {
                foreach ($gateway->data['enable_in_domains'] as $domainId => $status) {
                    if (!$status && $domainId == $domain->id) {
                        continue; // move to next gateway
                    }
                }
            }

            return $gateway;
        }

        return null;
    }


    /**
     * Undocumented function
     *
     * @return array
     */
    public function queueSMSMessagesForRequest(BatchSendSMSRequest $request)
    {
        ini_set('max_execution_time', 0);
        $ids = $request->getIds();
        $query = PhoneNumber::with('user')->select('number', 'user_id', 'flags');

        switch ($request->getType()) {
            case 'in_ids':
                $query->whereIn('user_id', $ids);
                break;
            case 'all_except_ids':
                $query->whereNotIn('user_id', $ids);
                break;
            case 'in_purchased_ids':
                $query->whereHas('user', function ($q) use ($ids) {
                    $q->whereHas('carts', function ($q) use ($ids) {
                        $q->whereIn('status', [Cart::STATUS_ACCESS_COMPLETE, Cart::STATUS_ACCESS_GRANTED]);
                        $q->whereHas('products', function ($q) use ($ids) {
                            $q->whereIn('id', $ids);
                        });
                    });
                });
                break;
            case 'not_in_purchased_ids':
                $query->whereDoesntHave('customer.carts', function ($q) use ($ids) {
                    $q->whereIn('status', [Cart::STATUS_ACCESS_COMPLETE, Cart::STATUS_ACCESS_GRANTED]);
                    $q->whereHas('products', function ($q) use ($ids) {
                        $q->whereIn('id', $ids);
                    });
                });
                break;
            case 'in_form_entries':
                $query->whereHas('customer.form_entries', function ($q) use ($ids) {
                    $q->whereIn('form_id', $ids);
                });
                break;
            case 'not_in_form_entries':
                $query->whereDoesntHave('user.form_entries', function ($q) use ($ids) {
                    $q->whereIn('form_id', $ids);
                });
                break;
            case 'in_form_entry_tags':
                $query->whereHas('user.form_entries', function ($q) use ($ids) {
                    $q->whereIn('tags', $ids);
                });
                break;
            case 'not_in_form_enty_tags':
                $query->whereDoesntHave('user.form_entries', function ($q) use ($ids) {
                    $q->whereIn('tags', $ids);
                });
                break;
        }

        /** @var IProfileUser */
        $user = Auth::user();

        /** @var ICRUDService */
        $crudService = app(ICRUDService::class);
        $provider = $crudService->makeCompositeProvider(config('larapress.crud.user.provider'));
        $query = $provider->onBeforeQuery($query);

        if ($request->shouldFilterDomains()) {
            $query->whereIn('domain_id', $request->getDomainIds());
        }
        if ($request->shouldFilterRoles()) {
            $query->whereHas('user.roles', function ($q) use ($request) {
                $q->whereIn('id', $request->getRoleIds());
            });
        }
        $from = $request->getRegisteredFrom();
        $to = $request->getRegisteredTo();

        if (!is_null($from) && !is_null($to)) {
            $query->whereBetween('created_at', [$from, $to]);
        } elseif (!is_null($from)) {
            $query->where('created_at', '>=', $from);
        } elseif (!is_null($to)) {
            $query->where('created_at', '<=', $to);
        }

        $msgCounter = 0;
        $query->chunk(100, function ($numbers) use (&$msgCounter, $user, $request) {
            $msgIds = [];
            foreach ($numbers as $number) {
                if (!BaseFlags::isActive($number->flags, PhoneNumber::FLAGS_DO_NOT_CONTACT)) {
                    $message = $this->getMessageForUser($request->getMessage(), $number->user);
                    $msg = SMSMessage::create([
                        'author_id' => $user->id,
                        'sms_gateway_id' => $request->getGatewayID(),
                        'from' => 'Batch SMS: ' . $user->id,
                        'to' => $number->number,
                        'message' => $message,
                        'flags' => SMSMessage::FLAGS_BATCH_SEND,
                        'status' => SMSMessage::STATUS_CREATED,
                        'data' => [
                            'mode' => 'batch',
                        ]
                    ]);
                    $msgCounter++;
                    $msgIds[] = $msg->id;
                }
            }
            BatchSendSMS::dispatch($msgIds, $request->getGatewayID(), $user->id);
        });

        return [
            'message' => trans('larapress::notifications.api.sms_queue_success', [
                'count' => $msgCounter
            ])
        ];
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function queueScheduledSMSMessages()
    {
        /** @var SMSMessage[] */
        $msgs = SMSMessage::query()
            ->distinct()
            ->where('status', SMSMessage::STATUS_CREATED)
            ->where('send_at', '>=', Carbon::now())
            ->get(['sms_gateway_id', 'author_id']);

        foreach ($msgs as $msg) {
            SMSMessage::query()
                ->select('id')
                ->where('status', SMSMessage::STATUS_CREATED)
                ->where('send_at', '>=', Carbon::now())
                ->where('author_id', $msg->author_id)
                ->where('sms_gateway_id', $msg->sms_gateway_id)
                ->chunk(100, function ($ids) use($msg) {
                    BatchSendSMS::dispatch($ids->pluck('id'), $msg->sms_gateway_id, $msg->author_id);
                });
        }
    }

    /**
     * Undocumented function
     *
     * @param string $message
     * @param IProfileUser $user
     * @return string
     */
    public function getMessageForUser($message, $user)
    {
        $firstname = isset($user->form_profile_default['data']['values']['firstname']) ? $user->form_profile_default['data']['values']['firstname'] : $user->name;
        $lastname = isset($user->form_profile_default['data']['values']['lastname']) ? $user->form_profile_default['data']['values']['lastname'] : '';
        $fullname = $firstname . ' ' . $lastname;
        $message = str_replace('$firstname', $firstname, $message);
        $message = str_replace('$lastname', $lastname, $message);
        $message = str_replace('$fullname', $fullname, $message);
        $message = str_replace('$id', $user->id, $message);

        return $message;
    }
}
