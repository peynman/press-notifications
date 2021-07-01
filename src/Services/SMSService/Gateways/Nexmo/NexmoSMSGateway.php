<?php


namespace Larapress\Notifications\Services\SMSService\Gateways\Nexmo;

use Larapress\Notifications\Services\SMSService\ISMSGateway;
use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;

/**
 * An implementation of ISMSGateway for Nexmo Provider
 */
class NexmoSMSGateway implements ISMSGateway
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
    public function config(array $conf)
    {
        $this->config = array_merge($this->config, $conf);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function init()
    {
        $basic = new Basic($this->config['client_id'], $this->config['client_secret']);
        $this->client = new Client($basic);
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
        $from = isset($options['from']) ? $options['from'] : config('notifications.sms.default-title');
        return $this->client->message()->sendText($number, $from, $message, [
            'type' => 'unicode',
        ])->getMessageId();
    }
}
