<?php

return [
    'permissions' => [
        \Larapress\Profiles\Metadata\UserMetadata::class,
        \Larapress\Profiles\Metadata\ActivityLogMetadata::class,
        \Larapress\Profiles\Metadata\ActivityLogMetadata::class,
        \Larapress\Profiles\Metadata\DomainMetadata::class,
        \Larapress\Profiles\Metadata\EmailAddressMetadata::class,
        \Larapress\Profiles\Metadata\PhoneNumberMetadata::class,
        \Larapress\Profiles\Metadata\SettingsMetadata::class,
        \Larapress\Profiles\Metadata\FilterMetadata::class,
        \Larapress\Profiles\Metadata\FormMetadata::class,
        \Larapress\Profiles\Metadata\FormEntryMetadata::class,
    ],

    'controllers' => [
        'crud' => [
            \Larapress\Profiles\CRUDControllers\UserController::class,
            \Larapress\Profiles\CRUDControllers\ActivityLogController::class,
            \Larapress\Profiles\CRUDControllers\DomainController::class,
            \Larapress\Profiles\CRUDControllers\EmailAddressController::class,
            \Larapress\Profiles\CRUDControllers\PhoneNumberController::class,
            \Larapress\Profiles\CRUDControllers\SettingsController::class,
            \Larapress\Profiles\CRUDControllers\FilterController::class,
            \Larapress\Profiles\CRUDControllers\FormController::class,
            \Larapress\Profiles\CRUDControllers\FormEntryController::class,
        ],
        'crud-render' => [
            \Larapress\Profiles\CRUDRenderControllers\UserRenderController::class,
            \Larapress\Profiles\CRUDRenderControllers\ActivityLogRenderController::class,
            \Larapress\Profiles\CRUDRenderControllers\DomainRenderController::class,
            \Larapress\Profiles\CRUDRenderControllers\EmailAddressRenderController::class,
            \Larapress\Profiles\CRUDRenderControllers\PhoneNumberRenderController::class,
            \Larapress\Profiles\CRUDRenderControllers\SettingsRenderController::class,
            \Larapress\Profiles\CRUDRenderControllers\FilterRenderController::class,
            \Larapress\Profiles\CRUDRenderControllers\FormRenderController::class,
            \Larapress\Profiles\CRUDRenderControllers\FormEntryRenderController::class,
        ]
    ],

    'security' => [
        'roles' => [
            'super-role' => [
                'super-role',
            ],
            'affiliate' => [
                'affiliate',
                'master',
            ],
            'customer' => [
                'customer',
            ],
        ],
    ],

    'defaults' => [
        'date-filter-interval' => '-1y',
        'cache-ttl' => '1d',
    ],

    'translations' => [
        'namespace' => 'larapress'
    ],

    'routes' => [
        'users' => [
            'name' => 'users',
        ],
        'user-affiliates' => [
            'name' => 'user-affiliates',
        ],
        'settings' => [
            'name' => 'settings',
        ],
        'phone-numbers' => [
            'name' => 'phone-numbers',
        ],
        'filters' => [
            'name' => 'filters',
        ],
        'emails' => [
            'name' => 'emails',
        ],
        'domains' => [
            'name' => 'domains',
        ],
        'devices' => [
            'name' => 'devices',
        ],
        'forms' => [
            'name' => 'forms',
        ],
        'form-entries' => [
            'name' => 'form-entries'
        ],
        'activity-logs' => [
            'name' => 'activity-logs',
        ],
    ],
];
