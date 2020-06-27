<?php

namespace Larapress\Notifications\Repository;

class SMSGatewayRepository implements ISMSGatewayRepository {

    /**
     * Undocumented function
     *
     * @param IProfileUser|ICRUDUser $user
     * @return array
     */
    public function getAllSMSGatewayTypes($user) {
        return [
            'farapayamak' => [
                'soap_url' => [
                    'type' => 'input',
                    'input' => 'text',
                    'label' => 'Soap URL'
                ],
                'username' => [
                    'type' => 'input',
                    'input' => 'text',
                    'label' => 'Username'
                ],
                'password' => [
                    'type' => 'input',
                    'input' => 'text',
                    'label' => 'Password'
                ],
                'phone_number' => [
                    'type' => 'input',
                    'input' => 'text',
                    'label' => 'Phone Number'
                ],
            ],
            'smsir' => [
                'api_key' => [
                    'type' => 'input',
                    'input' => 'text',
                    'label' => 'API Key'
                ],
                'secret_key' => [
                    'type' => 'input',
                    'input' => 'text',
                    'label' => 'Secret Key'
                ],
                'line_number' => [
                    'type' => 'input',
                    'input' => 'text',
                    'label' => 'Line number'
                ],
            ],
            'nexmo' => []
        ];
    }
}
