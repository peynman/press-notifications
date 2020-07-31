<?php


namespace Larapress\Notifications\SMSService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Larapress\CRUD\BaseFlags;
use Larapress\ECommerce\Models\Cart;
use Larapress\Notifications\Models\SMSGatewayData;
use Larapress\Notifications\Models\SMSMessage;
use Larapress\Notifications\SMSService\Jobs\BatchSendSMS;
use Larapress\Profiles\Models\Domain;
use Larapress\Profiles\Models\PhoneNumber;
use Larapress\Reports\Services\ITaskReportService;

use function Symfony\Component\String\b;

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
     * @return SMSMessage[]
     */
    public function queueSMSMessagesForRequest(BatchSendSMSRequest $request)
    {
        $numbers = [];
        $ids = $request->getIds();
        $query = PhoneNumber::select('number', 'user_id', 'flags');

        switch ($request->getType()) {
            case 'in_ids':
                $numbers = $query->whereIn('user_id', $ids)->get();
            break;
            case 'in_purchased_ids':

                $numbers = $query->whereHas('user', function($q) use($ids) {
                    $q->whereHas('carts', function($q) use($ids) {
                        $q->whereIn('status', [Cart::STATUS_ACCESS_COMPLETE, Cart::STATUS_ACCESS_GRANTED]);
                        $q->whereHas('products', function($q) use($ids) {
                            $q->whereIn('id', $ids);
                        });
                    });
                })->get();
            break;
            case 'not_in_purchased_ids':
                $numbers = $query->whereHas('customer', function($q) use($ids) {
                    $q->whereHas('carts', function($q) use($ids) {
                        $q->whereIn('status', [Cart::STATUS_ACCESS_COMPLETE, Cart::STATUS_ACCESS_GRANTED]);
                        $q->whereHas('products', function($q) use($ids) {
                            $q->whereNotIn('id', $ids);
                        });
                    });
                })->get();
            break;
            case 'in_form_entries':
                $numbers = $query->whereHas('customer', function($q) use($ids) {
                    $q->whereHas('entries', function($q) use($ids) {
                        $q->whereIn('form_id', $ids);
                    });
                })->get();
            break;
            case 'not_in_form_entries':
                $numbers = $query->whereHas('user', function($q) use($ids) {
                    $q->whereHas('entries', function($q) use($ids) {
                        $q->whereNotIn('form_id', $ids);
                    });
                })->get();
            break;
            case 'in_form_entry_tags':
                $numbers = $query->whereHas('user', function($q) use($ids) {
                    $q->whereHas('entries', function($q) use($ids) {
                        $q->whereIn('tags', $ids);
                    });
                })->get();
            break;
            case 'not_in_form_enty_tags':
                $numbers = $query->whereHas('user', function($q) use($ids) {
                    $q->whereHas('form_entries', function($q) use($ids) {
                        $q->whereNotIn('tags', $ids);
                    });
                })->get();
            break;
        }

        $msgIds = [];
        $user = Auth::user();
        foreach ($numbers as $number) {
            if (!BaseFlags::isActive($number->flags, PhoneNumber::FLAGS_DO_NOT_CONTACT)) {
                $smsMessage = SMSMessage::create([
                    'author_id' => $user->id,
                    'sms_gateway_id' => $request->getGatewayID(),
                    'from' => 'Batch SMS: '.$user->id,
                    'to' => $number->number,
                    'message' => $request->getMessage(),
                    'flags' => SMSMessage::FLAGS_BATCH_SEND,
                    'status' => SMSMessage::STATUS_CREATED,
                    'data' => [
                        'mode' => 'batch',
                    ]
                ]);
                $msgIds[] = $smsMessage->id;
            }
        }
        BatchSendSMS::dispatch($msgIds, $request->getGatewayID(), $user->name);

        return $msgIds;
    }
}
