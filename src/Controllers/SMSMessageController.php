<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\Services\CRUD\CRUDController;
use Larapress\Notifications\CRUD\SMSMessageCRUDProvider;
use Larapress\Notifications\Services\SMSService\BatchSendSMSRequest;
use Larapress\Notifications\Services\SMSService\ISMSService;
use Illuminate\Http\Response;

/**
 *
 * @group SMS Messages Management
 */
class SMSMessageController extends CRUDController
{
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
