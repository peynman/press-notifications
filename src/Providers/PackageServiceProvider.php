<?php

namespace Larapress\Notifications\Providers;

use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\ServiceProvider;
use Larapress\ECommerce\Repositories\BankGatewayRepository;
use Larapress\ECommerce\Repositories\IBankGatewayRepository;
use Larapress\Notifications\Repository\ISMSGatewayRepository;
use Larapress\Notifications\Repository\SMSGatewayRepository;
use Larapress\Notifications\Services\Notifications\INotificationService;
use Larapress\Notifications\Services\Notifications\NotificationService;
use Larapress\Notifications\Services\SMSService\ISMSService;
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
        $this->app->bind(IBankGatewayRepository::class, BankGatewayRepository::class);
        $this->app->bind(INotificationService::class, NotificationService::class);
    }

    /**
     * Bootstrap services.
     *
     * @param  BroadcastManager $broadcastManager
     * @return void
     */
    public function boot(BroadcastManager $broadcastManager)
    {
        $this->loadMigrationsFrom(__DIR__.'/../../migrations');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'larapress');

        $this->publishes([
            __DIR__.'/../../config/notifications.php' => config_path('larapress/notifications.php'),
        ], ['config', 'larapress', 'larapress-notifications']);
    }
}
