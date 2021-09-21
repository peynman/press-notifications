<?php

use Illuminate\Support\Facades\Route;
use Larapress\Notifications\Services\Chat\ChatController;

Route::middleware(config('larapress.crud.middlewares'))
    ->prefix(config('larapress.crud.prefix'))
    ->group(function () {
        ChatController::registerRoutes();
    });
