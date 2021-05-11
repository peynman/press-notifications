<?php

namespace Larapress\Auth\Tests\Feature;

use Larapress\CRUD\Tests\BaseCRUDTestTrait;
use Larapress\CRUD\Tests\PackageTestApplication;
use Larapress\Notifications\CRUD\SMSGatewayDataCRUDProvider;

class SMSGatewayDataCRUDTest extends PackageTestApplication
{
    use BaseCRUDTestTrait;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSMSGatewayCreate()
    {
        $this->doCRUDCreateTest(
            new SMSGatewayDataCRUDProvider(),
            [
                'name' => 'sample-gateway',
                'data' => [
                    'mocked' => true,
                    'gateway' => 'mockery'
                ],
            ]
        )   ->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'object' => [
                    'id',
                    'author_id',
                ]
            ]);
    }
}
