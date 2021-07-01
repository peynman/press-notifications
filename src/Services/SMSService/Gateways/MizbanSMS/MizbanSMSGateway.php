<?php

namespace Larapress\Notifications\Services\SMSService\Gateways\MizbanSMS;

use Exception;
use Larapress\Notifications\Services\SMSService\ISMSGateway;
use SoapClient;

/**
 * An implementation of ISMSGateway for FaraPayamak Provider
 */
class MizbanSMSGateway implements ISMSGateway
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
    public function config(array $conf)
    {
        if (!isset($conf['username']) || !isset($conf['password']) || !isset($conf['line_number']) || !isset($conf['api'])) {
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
        $this->client = new SoapClient("http://www.my.mizbansms.ir/WsSms.asmx?wsdl", [
            "trace" => 1
        ]);
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
        $result = $this->client->sendSMS([
            "username" => $this->config['username'],
            "password" => $this->config['password'],
            "from" => $this->config['line_number'],
            "to" => $number,
            "text" => $message,
            "api" => $this->config['api'],
        ], null, []);

        return $result;
    }
}
