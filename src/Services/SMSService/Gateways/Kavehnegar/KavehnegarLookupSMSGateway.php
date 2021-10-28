<?php


namespace Larapress\Notifications\Services\SMSService\Gateways\Kavehnegar;

use Larapress\Notifications\Services\SMSService\ISMSGateway;
use Exception;

/**
 * An implementation of ISMSGateway for Kavehnegar Provider
 */
class KavehnegarLookupSMSGateway implements ISMSGateway
{
    protected $config = [];
    /** @var \Kavenegar\KavenegarApi */
    protected $client = null;

    /**
     * Undocumented function
     *
     * @param array $conf
     * @return void
     */
    public function config(array $conf)
    {
        if (!isset($conf['api_key']) || !isset($conf['template'])) {
            throw new Exception("KavehnegarSMSGateway invalid config");
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
        $this->client = new \Kavenegar\KavenegarApi( $this->config['api_key'] );
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
        return $this->client->VerifyLookup($number, $message, null, null, $this->config['template']);
    }
}
