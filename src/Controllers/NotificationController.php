<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\CRUDControllers\BaseCRUDController;
use Larapress\Notifications\CRUD\NotificationCRUDProvider;
use Larapress\Notifications\Services\Notifications\BatchSendNotificationRequest;
use Larapress\Notifications\Services\Notifications\INotificationService;
use Illuminate\Http\Response;

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
                    'uses' => '\\'.self::class.'@sendBatchMessage',
                    'methods' => ['POST'],
                    'url' => config('larapress.notifications.routes.notifications.name').'/send',
                ]
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
    public function sendBatchMessage(INotificationService $service, BatchSendNotificationRequest $request) {
        return $service->queueBatchNotifications($request);
    }
}
