<?php

namespace Larapress\Notifications\Services\Notifications;

use Illuminate\Support\Facades\Auth;
use Larapress\ECommerce\Models\Cart;
use Larapress\Notifications\Models\Notification;
use Larapress\Profiles\IProfileUser;
use Larapress\CRUD\Services\CRUD\ICRUDProvider;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Database\Eloquent\Builder;
use Larapress\CRUD\Services\CRUD\ICRUDService;

class NotificationService implements INotificationService
{



    /**
     * Undocumented function
     *
     * @param BatchSendNotificationRequest $request
     *
     * @return StreamedResponse
     */
    public function exportNotificationUsers(BatchSendNotificationRequest $request)
    {
        ini_set('memory_limit', '1G');
        ini_set('max_execution_time', 0);

        $query = $this->getUsersForBatchRequest($request);

        $providerClass = config('larapress.crud.user.provider');
        /** @var ICRUDProvider */
        $provider = new $providerClass();

        return new StreamedResponse(function () use ($query, $provider) {
            $FH = fopen('php://output', 'w');
            $query->chunk(100, function ($users) use ($FH, $provider) {
                foreach ($users as $user) {
                    fputcsv($FH, $provider->getExportArray($user));
                }
            });
            fclose($FH);
        }, 200, [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ]);
    }

    /**
     * Undocumented function
     *
     * @param BatchSendNotificationRequest $request
     * @return Notification[]
     */
    public function queueBatchNotifications(BatchSendNotificationRequest $request)
    {
        $query = $this->getUsersForBatchRequest($request);

        $notifyCounter = 0;
        $author = Auth::user();
        $query->chunk(100, function ($users) use ($author, $request, &$notifyCounter) {
            foreach ($users as $user) {
                $message = $this->getMessageForUser($request->getMessage(), $user);
                $title = $this->getMessageForUser($request->getTitle(), $user);
                $link = $this->getLinkForUser($request->getLink(), $user);
                $data = [
                    'author_id' => $author->id,
                    'user_id' => $user->id,
                    'title' => $title,
                    'message' => $message,
                    'data' => [
                        'link' => $link,
                        'icon' => $request->getIcon(),
                        'color' => $request->getColor(),
                        'type' => $request->getNotificationType(),
                        'dismissable' => $request->isDismissable(),
                    ],
                    'flags' => 0,
                    'status' => Notification::STATUS_UNSEEN,
                ];

                Notification::create($data);
                $notifyCounter++;
            }
        });

        return [
            'message' => trans('larapress::notifications.api.notify_queue_success', [
                'count' => $notifyCounter
            ])
        ];
    }

    /**
     * Undocumented function
     *
     * @param BatchSendNotificationRequest $request
     *
     * @return Builder
     */
    protected function getUsersForBatchRequest(BatchSendNotificationRequest $request)
    {
        $ids = $request->getIds();
        $class = config('larapress.crud.user.model');
        $query = call_user_func([$class, 'select'], 'id', 'name');

        switch ($request->getType()) {
            case 'in_ids':
                $query->whereIn('id', $ids);
                break;
            case 'all_except_ids':
                $query->whereNotIn('id', $ids);
                break;
            case 'in_purchased_ids':
                $query->whereHas('carts', function ($q) use ($ids) {
                    $q->whereIn('status', [Cart::STATUS_ACCESS_COMPLETE, Cart::STATUS_ACCESS_GRANTED]);
                    $q->whereHas('products', function ($q) use ($ids) {
                        $q->whereIn('id', $ids);
                    });
                });
                break;
            case 'not_in_purchased_ids':
                $query->whereDoesntHave('carts', function ($q) use ($ids) {
                    $q->whereIn('status', [Cart::STATUS_ACCESS_COMPLETE, Cart::STATUS_ACCESS_GRANTED]);
                    $q->whereHas('products', function ($q) use ($ids) {
                        $q->whereIn('id', $ids);
                    });
                });
                break;
            case 'in_form_entries':
                $query->whereHas('form_entries', function ($q) use ($ids) {
                    $q->whereIn('form_id', $ids);
                });
                break;
            case 'not_in_form_entries':
                $query->whereDoesntHave('form_entries', function ($q) use ($ids) {
                    $q->whereIn('form_id', $ids);
                });
                break;
            case 'in_form_entry_tags':
                $query->whereHas('form_entries', function ($q) use ($ids) {
                    $q->whereIn('tags', $ids);
                });
                break;
            case 'not_in_form_enty_tags':
                $query->whereDoesntHave('form_entries', function ($q) use ($ids) {
                    $q->whereIn('tags', $ids);
                });
                break;
        }

        /** @var ICRUDService */
        $crudService = app(ICRUDService::class);
        $provider = $crudService->makeCompositeProvider(config('larapress.crud.user.provider'));
        $query = $provider->onBeforeQuery($query);

        if ($request->shouldFilterDomains()) {
            $query->whereHas('domains', function ($q) use ($request) {
                $q->whereIn('id', $request->getDomainIds());
            });
        }
        if ($request->shouldFilterRoles()) {
            $query->whereHas('roles', function ($q) use ($request) {
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

        return $query;
    }

    /**
     * Undocumented function
     *
     * @param IProfileUser $user
     * @param int $notification_id
     * @return array
     */
    public function dismissNotificationForUser(IProfileUser $user, $notification_id)
    {
        $notification = Notification::where('user_id', $user->id)->where('id', $notification_id)->first();
        if (!is_null($notification)) {
            $notification->update([
                'status' => Notification::STATUS_DISMISSED
            ]);
        }

        return [
            'message' => trans('larapress::notifications.api.notify_dismiss_success')
        ];
    }


    /**
     * Undocumented function
     *
     * @param IProfileUser $user
     * @param int $notification_id
     * @return string
     */
    public function viewNotificationForUser(IProfileUser $user, $notification_id)
    {
        $notification = Notification::where('user_id', $user->id)->where('id', $notification_id)->first();
        if (!is_null($notification)) {
            $notification->update([
                'status' => Notification::STATUS_SEEN
            ]);
        }

        return $notification->data['link'];
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
        $firstname = isset($user->profile['data']['values']['firstname']) ? $user->profile['data']['values']['firstname'] : $user->name;
        $lastname = isset($user->profile['data']['values']['lastname']) ? $user->profile['data']['values']['lastname'] : '';
        $fullname = $firstname.' '.$lastname;
        $message = str_replace('$firstname', $firstname, $message);
        $message = str_replace('$lastname', $lastname, $message);
        $message = str_replace('$fullname', $fullname, $message);
        return $message;
    }

    /**
     * Undocumented function
     *
     * @param string $link
     * @param IProfileUser $user
     * @return void
     */
    public function getLinkForUser($link, $user)
    {
        $link = str_replace('$id', $user->id, $link);
        return $link;
    }
}
