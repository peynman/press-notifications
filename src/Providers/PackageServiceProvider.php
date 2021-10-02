<?php

namespace Larapress\Notifications\Providers;

use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\ServiceProvider;
use Larapress\Notifications\Services\Notifications\INotificationService;
use Larapress\Notifications\Services\Notifications\INotificationsRepository;
use Larapress\Notifications\Services\Notifications\NotificationService;
use Larapress\Notifications\Services\Notifications\NotificationsRepository;
use Larapress\Notifications\Services\SMSService\ISMSGatewayRepository;
use Larapress\Notifications\Services\SMSService\ISMSService;
use Larapress\Notifications\Services\SMSService\SMSGatewayRepository;
use Larapress\Notifications\Services\SMSService\SMSService;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ISMSService::class, SMSService::class);
        $this->app->bind(ISMSGatewayRepository::class, SMSGatewayRepository::class);
        $this->app->bind(INotificationService::class, NotificationService::class);
        $this->app->bind(INotificationsRepository::class, NotificationsRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @param  BroadcastManager $broadcastManager
     * @return void
     */
    public function boot(BroadcastManager $broadcastManager)
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'larapress');
        $this->loadMigrationsFrom(__DIR__.'/../../migrations');

        $this->publishes([
            __DIR__.'/../../config/notifications.php' => config_path('larapress/notifications.php'),
        ], ['config', 'larapress', 'larapress-notifications']);
    }
}
