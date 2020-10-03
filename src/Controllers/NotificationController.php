<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\CRUDControllers\BaseCRUDController;
use Larapress\Notifications\CRUD\NotificationCRUDProvider;
use Larapress\Notifications\Services\Notifications\BatchSendNotificationRequest;
use Larapress\Notifications\Services\Notifications\INotificationService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
     * Undocumented function
     *
     * @param INotificationService $service
     * @param BatchSendNotificationRequest $request
     * @return Response
     */
    public function exportNotificationUsers(INotificationService $service, BatchSendNotificationRequest $request) {
        return $service->exportNotificationUsers($request);
    }

    /**
     * Undocumented function
     *
     * @param INotificationService $service
     * @param BatchSendNotificationRequest $request
     * @return Response
     */
    public function sendBatchNotification(INotificationService $service, BatchSendNotificationRequest $request) {
        return $service->queueBatchNotifications($request);
    }

    /**
     * Undocumented function
     *
     * @param INotificationService $service
     * @param BatchSendNotificationRequest $request
     * @return Response
     */
    public function dismissNotification(INotificationService $service, $notification_id) {
        return $service->dismissNotificationForUser(Auth::user(), $notification_id);
    }

    /**
     * Undocumented function
     *
     * @param INotificationService $service
     * @param BatchSendNotificationRequest $request
     * @return Response
     */
    public function viewNotification(INotificationService $service, $notification_id) {
        return $service->viewNotificationForUser(Auth::user(), $notification_id);
    }
}
