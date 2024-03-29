<?php

namespace Larapress\Notifications\Services\SMSService\Jobs;

use Larapress\Notifications\Models\SMSMessage;
use Larapress\Notifications\Services\SMSService\ISMSService;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Larapress\CRUD\BaseFlags;
use Larapress\CRUD\Events\CRUDUpdated;
use Larapress\CRUD\Exceptions\AppException;
use Larapress\Notifications\CRUD\SMSMessageCRUDProvider;
use Larapress\Notifications\Models\SMSGatewayData;
use Larapress\Notifications\Services\SMSService\ISMSGateway;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var SMSMessage
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * @param SMSMessage $message
     */
    public function __construct(SMSMessage $message)
    {
        $this->message = $message;
        // $this->onQueue(config('larapress.crud.queue'));
    }

    public function tags()
    {
        return ['send-sms', 'message:'.$this->message->id];
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $gatewayData = $this->message->sms_gateway;
        if (is_null($gatewayData) || BaseFlags::isActive($gatewayData->flags, SMSGatewayData::FLAGS_DISABLED)) {
            throw new Exception("SMS Message does not have an active gateway");
        }

        $now = Carbon::now();
        try {
            /** @var ISMSGateway */
            $gateway = $gatewayData->getGateway();
            $gateway->init();

            $msg_id = $gateway->sendSMS($this->message->to, $this->message->message, [
                'from' => $this->message->from,
            ]);
            $data = $this->message->data;
            if (is_null($data)) {
                $data = [];
            }
            $data['provider_event_id'] = $msg_id;

            $this->message->update([
                'status' => SMSMessage::STATUS_SENT,
                'sent_at' => $now,
                'data' => $data,
            ]);

            CRUDUpdated::dispatch($this->message->author, $this->message, SMSMessageCRUDProvider::class, $now);
        } catch (\Exception $e) {
            $this->message->update([
                'status' => SMSMessage::STATUS_FAILED_SEND,
            ]);
            CRUDUpdated::dispatch($this->message->author, $this->message, SMSMessageCRUDProvider::class, $now);
            Log::critical('SMS Send Failed: '.$e->getMessage(), $e->getTrace());
            throw new AppException(AppException::ERR_REJECTED_RESULT);
        }
    }
}
