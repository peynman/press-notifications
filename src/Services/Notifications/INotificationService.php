<?php

namespace Larapress\Notifications\Services\Notifications;

interface INotificationService {
    /**
     * Undocumented function
     *
     * @param BatchSendNotificationRequest $request
     * @return Notification[]
     */
    public function queueBatchNotifications(BatchSendNotificationRequest $request);
}
