<?php

namespace Larapress\Notifications\Repository;

use Larapress\CRUD\Extend\Helpers;
use Larapress\Notifications\Models\SMSGatewayData;

class SMSGatewayRepository implements ISMSGatewayRepository
{

    /**
     * Undocumented function
     *
     * @param IProfileUser|ICRUDUser $user
     * @return array
     */
    public function getAllSMSGatewayTypes($user)
    {
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
            'smsir_simple' => [
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
            'smsir_fast' => [
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
                'template_id' => [
                    'type' => 'input',
                    'input' => 'text',
                    'label' => 'Template ID',
                ]
            ],
            'nexmo' => []
        ];
    }

    /**
     * Undocumented function
     *
     * @param [type] $user
     * @return void
     */
    public function getSMSGateways($user)
    {
        if (
            $user->hasRole(config('larapress.profiles.security.roles.super-role')) ||
            $user->hasRole(config('larapress.profiles.security.roles.affiliate'))
        ) {
            return SMSGatewayData::select(['id', 'name'])->get();
        }

        return [];
    }
}
