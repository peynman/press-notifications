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
use Larapress\CRUD\BaseFlags;
use Larapress\Notifications\Models\SMSGatewayData;

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
	    $this->onQueue(config('larapress.notifications.sms.queue'));
    }

	/**
	 * Execute the job.
	 *
	 * @param ISMSService $service
	 *
	 * @return void
	 */
    public function handle(ISMSService $service)
    {
        $gatewayData = $this->message->sms_gateway;
        if (is_null($gatewayData) || BaseFlags::isActive($gatewayData->flags ,SMSGatewayData::FLAGS_DISABLED)) {
            throw new Exception("SMS Message does not have an active gateway");
        }

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
                'sent_at' => Carbon::now(),
                'data' => $data,
		    ]);
	    } catch (\Exception $e) {
	    	$this->message->update([
	    		'status' => SMSMessage::STATUS_FAILED_SEND,
            ]);
            throw new Exception("Failed sending SMSM Message", 0, $e);
	    }
    }
}
