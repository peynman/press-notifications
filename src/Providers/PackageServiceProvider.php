<?php

namespace Larapress\RabbitMQ\Providers;

use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\ServiceProvider;
use Larapress\RabbitMQ\Broadcaster\RabbitMQBroadcaster;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @param  BroadcastManager $broadcastManager
     * @return void
     */
    public function boot(BroadcastManager $broadcastManager)
    {
        $this->publishes([
            __DIR__.'/../../config/rabbitmq.php' => config_path('larapress/rabbitmq.php'),
        ], ['config', 'larapress', 'larapress-rabbitmq']);

        $broadcastManager->extend('rabbitmq', function ($app, array $config) {
            return new RabbitMQBroadcaster();
        });
    }
}
