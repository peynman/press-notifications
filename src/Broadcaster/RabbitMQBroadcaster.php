<?php

namespace Larapress\Notifications\Broadcaster;

use Illuminate\Broadcasting\Broadcasters\Broadcaster;
use Illuminate\Support\Facades\Log;

class RabbitMQBroadcaster extends Broadcaster
{
    /**
     * Authenticate the incoming request for a given channel.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function auth($request)
    {
        Log::debug('auth', $request->all());
    }

    /**
     * Return the valid authentication response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $result
     * @return mixed
     */
    public function validAuthenticationResponse($request, $result)
    {
        Log::debug('validAuthenticationResponse', $request->all());
        // TODO: Implement validAuthenticationResponse() method.
    }

    /**
     * Broadcast the given event.
     *
     * @param  array $channels
     * @param  string $event
     * @param  array $payload
     * @return void
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
        Log::debug('broadcast', [$channels, $event, $payload]);
        // TODO: Implement broadcast() method.
    }
}
