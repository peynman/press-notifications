<?php

namespace Larapress\Notifications\SMSService\Jobs;

use Larapress\Notifications\Models\SMSMessage;
use Larapress\Notifications\SMSService\ISMSService;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Larapress\CRUD\BaseFlags;
use Larapress\CRUD\Events\CRUDUpdated;
use Larapress\CRUD\Exceptions\AppException;
use Larapress\Notifications\CRUD\SMSMessageCRUDProvider;
use Larapress\Notifications\Models\SMSGatewayData;
use Larapress\Reports\Services\ITaskReportService;

class BatchSendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $messageIds;
    private $gatewayId;
    private $sender;
    /**
     * Create a new job instance.
     *
     * @param array $ids
     */
    public function __construct(array $ids, $gateway_id, $sender)
    {
        $this->messageIds = $ids;
        $this->gatewayId = $gateway_id;
        $this->sender = $sender;

        // $this->onQueue(config('larapress.crud.queue'));
    }

    public function tags()
    {
        return ['batch-send-sms'];
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ITaskReportService $service)
    {
        $gatewayData = SMSGatewayData::find($this->gatewayId);
        if (is_null($gatewayData) || BaseFlags::isActive($gatewayData->flags, SMSGatewayData::FLAGS_DISABLED)) {
            throw new Exception("SMS Message does not have an active gateway");
        }

        $service->startSyncronizedTaskReport(
            'send-sms',
            'batch-send-sms-'.$this->sender,
            'Sending messages...',
            [],
            function ($onUpdated, $onSuccess, $onFailed) use ($gatewayData) {
                try {
                    /** @var ISMSGateway */
                    $gateway = $gatewayData->getGateway();
                    $gateway->init();

                    SMSMessage::whereIn('id', $this->messageIds)->chunk('100', function ($messages) use ($gateway) {
                        foreach ($messages as $message) {
                            $msg_id = $gateway->sendSMS($message->to, $message->message, [
                                'from' => $message->from,
                            ]);
                            $data = $message->data;
                            if (is_null($data)) {
                                $data = [];
                            }
                            $data['provider_event_id'] = $msg_id;

                            $now = Carbon::now();
                            $message->update([
                                'status' => SMSMessage::STATUS_SENT,
                                'sent_at' => $now,
                                'data' => $data,
                            ]);

                            CRUDUpdated::dispatch($message, SMSMessageCRUDProvider::class, $now);
                        }
                    });
                    $onSuccess('Finished', []);
                } catch (\Exception $e) {
                    $onSuccess('Failed', []);
                    Log::critical('Batch SMS Send Failed: ' . $e->getMessage(), $e->getTrace());
                    throw new AppException(AppException::ERR_REJECTED_RESULT);
                }
            }
        );
    }
}
