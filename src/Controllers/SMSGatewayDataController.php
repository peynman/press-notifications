<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\Services\CRUD\CRUDController;
use Larapress\Notifications\CRUD\SMSGatewayDataCRUDProvider;

/**
 * Standard CRUD Controller for SMS Gateway resource.
 *
 * @group SMS Gateways Management
 */
class SMSGatewayDataController extends CRUDController
{
    public static function registerRoutes()
    {
        parent::registerCrudRoutes(
            config('larapress.notifications.routes.sms_gateways.name'),
            self::class,
            config('larapress.notifications.routes.sms_gateways.provider'),
        );
    }
}
