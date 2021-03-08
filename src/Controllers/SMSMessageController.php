<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\CRUDControllers\BaseCRUDController;
use Larapress\Notifications\CRUD\SMSMessageCRUDProvider;
use Larapress\Notifications\Services\SMSService\BatchSendSMSRequest;
use Larapress\Notifications\Services\SMSService\ISMSService;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function sendBatchMessage(ISMSService $service, BatchSendSMSRequest $request)
    {
        return $service->queueSMSMessagesForRequest($request);
    }
}
