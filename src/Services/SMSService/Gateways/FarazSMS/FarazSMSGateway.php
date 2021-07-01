<?php


namespace Larapress\Notifications\Services\SMSService\Gateways\FarazSMS;

use Larapress\Notifications\Services\SMSService\ISMSGateway;
use Exception;
use CurlHandle;

/**
 * An implementation of ISMSGateway for Nexmo Provider
 */
class FarazSMSGateway implements ISMSGateway
{
    protected $config = [];
    /** @var CurlHandle */
    protected $client = null;

    /**
     * Undocumented function
     *
     * @param array $conf
     * @return void
     */
    public function config(array $conf)
    {
        if (!isset($conf['username']) || !isset($conf['password']) || !isset($conf['number'])) {
            throw new Exception("FarazSMS invalid config");
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
        $url = "https://ippanel.com/services.jspd";
		$this->client = curl_init($url);
		curl_setopt($this->client, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($this->client, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param String $number
     * @param String $message
     * @param array $options
     *
     * @return null|string
     */
    public function sendSMS(String $number, String $message, array $options)
    {
		curl_setopt($this->client, CURLOPT_POSTFIELDS, [
            'uname' => $this->config['username'],
            'pass' =>  $this->config['username'],
            'from' =>  $this->config['username'],
            'message' => $message,
            'to' => json_encode($number),
            'op' => 'send'
        ]);
        $response = curl_exec($this->client);
        return $response;
    }
}
