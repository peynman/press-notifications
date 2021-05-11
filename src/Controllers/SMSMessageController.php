<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\Services\CRUD\BaseCRUDController;
use Larapress\Notifications\CRUD\SMSMessageCRUDProvider;
use Larapress\Notifications\Services\SMSService\BatchSendSMSRequest;
use Larapress\Notifications\Services\SMSService\ISMSService;
use Illuminate\Http\Response;

/**
 * Standard CRUD Controller for SMS Message resource.
 *
 * @group SMS Messages Management
 */
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
     * Batch Send
     *
     * @return Response
     */
    public function sendBatchMessage(ISMSService $service, BatchSendSMSRequest $request)
    {
        return $service->queueSMSMessagesForRequest($request);
    }
}
