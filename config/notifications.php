<?php

return [
    'sms' => [
        'default-title' => 'SMSService',
        'queue' => 'listeners',
        'gateways' => [
            'nexmo' => \Larapress\Notifications\Services\SMSService\Gatewayes\NexmoSMSGateway::class,
            'farapayamak' => \Larapress\Notifications\Services\SMSService\Gatewayes\FaraPayamakSMSGateway::class,
            'smsir_fast' => \Larapress\Notifications\Services\SMSService\Gateways\SMSIRFastGateway::class,
            'smsir_simple' => \Larapress\Notifications\Services\SMSService\Gateways\SMSIRSimpleGateway::class,
            'mizbansms' => \Larapress\Notifications\Services\SMSService\Gateways\MizbanSMSGateway::class,
        ],
    ],

    'permissions' => [
        \Larapress\Notifications\CRUD\NotificationCRUDProvider::class,
        \Larapress\Notifications\CRUD\SMSGatewayDataCRUDProvider::class,
        \Larapress\Notifications\CRUD\SMSMessageCRUDProvider::class,
    ],

    'controllers' => [
        \Larapress\Notifications\Controllers\NotificationController::class,
        \Larapress\Notifications\Controllers\SMSGatewayDataController::class,
        \Larapress\Notifications\Controllers\SMSMessageController::class,
    ],

    'routes' => [
        'notifications' => [
            'name' => 'notifications',
            'model' => \Larapress\Notifications\Models\Notification::class,
        ],
        'sms_gateways' => [
            'name' => 'sms-gateways',
            'model' => \Larapress\Notifications\Models\SMSGatewayData::class,
        ],
        'sms_messages' => [
            'name' => 'sms-messages',
            'model' => \Larapress\Notifications\Models\SMSMessage::class,
        ]
    ],
];
