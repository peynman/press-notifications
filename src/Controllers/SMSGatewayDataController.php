<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\CRUDControllers\BaseCRUDController;
use Larapress\Notifications\CRUD\SMSGatewayDataCRUDProvider;

class SMSGatewayDataController extends BaseCRUDController
{
    public static function registerRoutes()
    {
        parent::registerCrudRoutes(
            config('larapress.notifications.routes.sms_gateways.name'),
            self::class,
            SMSGatewayDataCRUDProvider::class
        );
    }
}
