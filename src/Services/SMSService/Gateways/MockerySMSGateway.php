<?php

namespace Larapress\Notifications\Services\SMSService\Gateways;

use Larapress\Notifications\Services\SMSService\ISMSGateway;

/**
 * An implementation of ISMSGateway for FaraPayamak Provider
 */
class MockerySMSGateway implements ISMSGateway
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
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function init()
    {
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
        return true;
    }
}
