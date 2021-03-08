<?php

namespace Larapress\Notifications\Services\Notifications;

use Larapress\Profiles\IProfileUser;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface INotificationService
{

    /**
     * Undocumented function
     *
     * @param BatchSendNotificationRequest $request
     * @return StreamedResponse
     */
    public function exportNotificationUsers(BatchSendNotificationRequest $request);

    /**
     * Undocumented function
     *
     * @param BatchSendNotificationRequest $request
     * @return Notification[]
     */
    public function queueBatchNotifications(BatchSendNotificationRequest $request);

    /**
     * Undocumented function
     *
     * @return array
     */
    public function dismissNotificationForUser(IProfileUser $user, $notification_id);

    /**
     * Undocumented function
     *
     * @param IProfileUser $user
     * @param int $notification_id
     * @return string
     */
    public function viewNotificationForUser(IProfileUser $user, $notification_id);
}
