<?php

namespace Larapress\Notifications\Services\SMSService\Gateways;

use Exception;
use Illuminate\Support\Facades\Log;
use Larapress\Notifications\Services\SMSService\Gateways\SMSIR\UltraFastSend;
use Larapress\Notifications\Services\SMSService\ISMSGateway;

/**
 * An implementation of ISMSGateway for FaraPayamak Provider
 */
class SMSIRFastGateway implements ISMSGateway
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
        if (!isset($conf['api_key']) || !isset($conf['secret_key']) || !isset($conf['line_number']) || !isset($conf['template_id'])) {
            throw new Exception("SMSIR invalid config");
        }

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
            'TemplateId' => $this->config['template_id'],
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
