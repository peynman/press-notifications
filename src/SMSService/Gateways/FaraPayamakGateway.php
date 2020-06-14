<?php

namespace Larapress\Notifications\SMSService\Gatewayes;

use Exception;
use Larapress\Notifications\SMSService\ISMSGateway;
use SoapClient;

/**
 * An implementation of ISMSGateway for FaraPayamak Provider
 */
class FaraPayamakSMSGateway implements ISMSGateway
{
	protected $config = [];
	/** @var Client */
	protected $client = null;

    /**
     * Undocumented function
     *
     * @param array $conf
     * @return void
     */
	public function config( array $conf )
	{
        if (!isset($conf['soap_url']) || !isset($conf['username']) || !isset($conf['password']) || !isset($conf['phone_number'])) {
            throw new Exception("Farapayamak invalid config");
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
        $this->client = new SoapClient($this->config['soap_url']);
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
        $data = [
            'username' => $this->config['username'],
            'password' => $this->config['password'],
            'from' => $this->config['phone_number'],
            'to' => $number,
            'text' => $message,
            'isflash' => isset($options['flash']) ? $options['flash']:false,
        ];
        $result = $this->client->SendSimpleSMS2($data);
        return $result;
	}

}
