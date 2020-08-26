<?php


namespace Larapress\Notifications\Services\SMSService;

/**
 * An SMS Service gateway interface,
 *   is responsible for actully sending sms messages to destination
 *   in real world we will use a third party provider thoagh
 */
interface ISMSGateway
{
    /**
     * Undocumented function
     *
     * @param array $conf
     * @return void
     */
	public function config(array $conf);

    /**
     * Undocumented function
     *
     * @param String $number
     * @param String $message
     * @param array $options
     * @return void
     */
	public function sendSMS(String $number, String $message, array $options);

    /**
     * Undocumented function
     *
     * @return void
     */
	public function init();
}
