<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\Services\CRUD\CRUDController;
use Larapress\Notifications\Services\Notifications\BatchSendNotificationRequest;
use Larapress\Notifications\Services\Notifications\INotificationService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Larapress\Profiles\IProfileUser;

/**
 * @group Notifications Management
 */
class NotificationController extends CRUDController
{
    /**
     * Export Users List
     *
     * @param INotificationService $service
     * @param BatchSendNotificationRequest $request
     * @return Response
     */
    public function exportNotificationUsers(INotificationService $service, BatchSendNotificationRequest $request)
    {
        return $service->exportNotificationUsers($request);
    }

    /**
     * Send Batch
     *
     * @param INotificationService $service
     * @param BatchSendNotificationRequest $request
     * @return Response
     */
    public function sendBatchNotification(INotificationService $service, BatchSendNotificationRequest $request)
    {
        return $service->queueBatchNotifications($request);
    }

    /**
     * Dismiss Notification
     *
     * @param INotificationService $service
     * @param BatchSendNotificationRequest $request
     * @return Response
     */
    public function dismissNotification(INotificationService $service, $notification_id)
    {
        /** @var IProfileUser */
        $user = Auth::user();
        return $service->dismissNotificationForUser($user, $notification_id);
    }

    /**
     * View Notification
     *
     * @param INotificationService $service
     * @param BatchSendNotificationRequest $request
     * @return Response
     */
    public function viewNotification(INotificationService $service, $notification_id)
    {
        /** @var IProfileUser */
        $user = Auth::user();
        return $service->viewNotificationForUser($user, $notification_id);
    }
}
