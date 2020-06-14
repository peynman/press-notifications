<?php

use Larapress\Notifications\SMSService\Gatewayes\FaraPayamakSMSGateway;
use Larapress\Notifications\SMSService\Gatewayes\NexmoSMSGateway;

return [
    'sms' => [
        'default-title' => 'SMSService',
        'queue' => 'listeners',
        'gateways' => [
            'nexmo' => NexmoSMSGateway::class,
            'farapayamak' => FaraPayamakSMSGateway::class,
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
