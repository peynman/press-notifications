<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\Services\CRUD\BaseCRUDController;
use Larapress\Notifications\CRUD\NotificationCRUDProvider;
use Larapress\Notifications\Services\Notifications\BatchSendNotificationRequest;
use Larapress\Notifications\Services\Notifications\INotificationService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Larapress\Profiles\IProfileUser;

/**
 * Standard CRUD Controller for Notification resource.
 *
 * @group Notifications Management
 */
class NotificationController extends BaseCRUDController
{
    public static function registerRoutes()
    {
        parent::registerCrudRoutes(
            config('larapress.notifications.routes.notifications.name'),
            self::class,
            NotificationCRUDProvider::class,
            [
                'send' => [
                    'uses' => '\\'.self::class.'@sendBatchNotification',
                    'methods' => ['POST'],
                    'url' => config('larapress.notifications.routes.notifications.name').'/send',
                ],
                'export' => [
                    'uses' => '\\'.self::class.'@exportNotificationUsers',
                    'methods' => ['POST'],
                    'url' => config('larapress.notifications.routes.notifications.name').'/export',
                ],
                'any.dismiss' => [
                    'uses' => '\\'.self::class.'@dismissNotification',
                    'methods' => ['POST'],
                    'url' => config('larapress.notifications.routes.notifications.name').'/dismiss/{notification_id}'
                ],
                'any.view' => [
                    'uses' => '\\'.self::class.'@viewNotification',
                    'methods' => ['POST'],
                    'url' => config('larapress.notifications.routes.notifications.name').'/view/{notification_id}'
                ],
            ]
        );
    }



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
        return $service->dismissNotificationForUser(Auth::user(), $notification_id);
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
        return $service->viewNotificationForUser(Auth::user(), $notification_id);
    }
}
