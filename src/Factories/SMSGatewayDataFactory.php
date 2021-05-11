<?php

namespace Larapress\Notifications\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Larapress\Notifications\Models\SMSGatewayData;

class SMSGatewayDataFactory extends Factory {
    protected $model = SMSGatewayData::class;

    public function definition()
    {
        $title = $this->faker->words(1, true);
        return [
            'name' => str_replace(' ', '-', strtolower($title)),
            'author_id' => 1,
            'flags' => 0,
            'data' => [
                'gateway' => 'mockery',
            ],
        ];
    }
}
