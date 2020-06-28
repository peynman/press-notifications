<?php

namespace Larapress\Notifications\SMSService\Gateways;

use Exception;
use Illuminate\Support\Facades\Log;
use Larapress\Notifications\SMSService\Gateways\SMSIR\UltraFastSend;
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
        $this->client = new UltraFastSend(
            $this->config['api_key'],
            $this->config['secret_key']
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
        $result = $this->client->UltraFastSend([
            'Mobile' => $number,
            'TemplateId' => 10909,
            'ParameterArray' => [
                [
                    'Parameter' => 'VerificationCode',
                    'ParameterValue' => $message
                ]
            ]
        ]);
        return $result;
	}

}
