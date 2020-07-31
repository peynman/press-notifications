<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\CRUDControllers\BaseCRUDController;
use Larapress\Notifications\CRUD\SMSMessageCRUDProvider;
use Larapress\Notifications\SMSService\BatchSendSMSRequest;
use Larapress\Notifications\SMSService\ISMSService;

class SMSMessageController extends BaseCRUDController
{
    public static function registerRoutes()
    {
        parent::registerCrudRoutes(
            config('larapress.notifications.routes.sms_messages.name'),
            self::class,
            SMSMessageCRUDProvider::class,
            [
                'send' => [
                    'uses' => '\\'.self::class.'@sendBatchMessage',
                    'methods' => ['POST'],
                    'url' => config('larapress.notifications.routes.sms_messages.name').'/send',
                ]
            ]
        );
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function sendBatchMessage(ISMSService $service, BatchSendSMSRequest $request) {
        return $service->queueSMSMessagesForRequest($request);
    }
}
