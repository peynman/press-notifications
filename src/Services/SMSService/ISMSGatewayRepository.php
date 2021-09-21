<?php

namespace Larapress\Notifications\Services\SMSService;

interface ISMSGatewayRepository
{

    /**
     * @param IProfileUser|ICRUDUser $user
     * @return array
     */
    public function getAllSMSGatewayTypes($user);


    /**
     * Undocumented function
     *
     * @param [type] $user
     * @return void
     */
    public function getSMSGateways($user);
}
