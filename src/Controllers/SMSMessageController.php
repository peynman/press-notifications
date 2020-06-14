<?php

namespace Larapress\Notifications\Controllers;

use Larapress\CRUD\CRUDControllers\BaseCRUDController;
use Larapress\Notifications\CRUD\SMSMessageCRUDProvider;

class SMSMessageController extends BaseCRUDController
{
    public static function registerRoutes()
    {
        parent::registerCrudRoutes(
            config('larapress.notifications.routes.sms_messages.name'),
            self::class,
            SMSMessageCRUDProvider::class
        );
    }
}
