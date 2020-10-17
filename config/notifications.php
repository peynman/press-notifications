<?php

use Larapress\Notifications\Services\SMSService\Gatewayes\FaraPayamakSMSGateway;
use Larapress\Notifications\Services\SMSService\Gatewayes\NexmoSMSGateway;
use Larapress\Notifications\Services\SMSService\Gateways\MizbanSMSGateway;
use Larapress\Notifications\Services\SMSService\Gateways\SMSIRFastGateway;
use Larapress\Notifications\Services\SMSService\Gateways\SMSIRSimpleGateway;

return [
    'sms' => [
        'default-title' => 'SMSService',
        'queue' => 'listeners',
        'gateways' => [
            'nexmo' => NexmoSMSGateway::class,
            'farapayamak' => FaraPayamakSMSGateway::class,
            'smsir_fast' => SMSIRFastGateway::class,
            'smsir_simple' => SMSIRSimpleGateway::class,
            'mizbansms' => MizbanSMSGateway::class,
        ],
    ],

    'routes' => [
        'notifications' => [
            'name' => 'notifications',
        ],
        'sms_gateways' => [
            'name' => 'sms-gateways'
        ],
        'sms_messages' => [
            'name' => 'sms-messages'
        ]
    ],
];
