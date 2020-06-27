<?php

namespace Larapress\Notifications\SMSService\Gateways;

use Exception;
use Illuminate\Support\Facades\Log;
use Larapress\Notifications\SMSService\Gateways\SMSIR\SendMessage;
use Larapress\Notifications\SMSService\ISMSGateway;

/**
 * An implementation of ISMSGateway for FaraPayamak Provider
 */
class SMSIRGateway implements ISMSGateway
{
	protected $config = [];
	/** @var SmsIR_SendMessage */
	protected $client = null;

    /**
     * Undocumented function
     *
     * @param array $conf
     * @return void
     */
	public function config( array $conf )
	{
        if (!isset($conf['api_key']) || !isset($conf['secret_key']) || !isset($conf['line_number'])) {
            throw new Exception("SMSIR invalid config");
        }

        Log::debug(json_encode($conf));

        $this->config = $conf;
	}

    /**
     * Undocumented function
     *
     * @return void
     */
	public function init()
	{
        ini_set("soap.wsdl_cache_enabled", "0");
        $this->client = new SendMessage(
            $this->config['api_key'],
            $this->config['secret_key'],
            $this->config['line_number']
        );
	}

	/**
 * @param String $number
	 * @param String $message
	 * @param array $options
	 *
	 * @return null|string
	 */
	function sendSMS( String $number, String $message, array $options )
	{
        $result = $this->client->SendMessage([$number], [$message], date("Y-m-d")."T".date("H:i:s"));
        Log::debug('SMS Sent: '. $result.' :: '.json_encode($this->config));
        return $result;
	}

}
