<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testFromLessThanTo()
    {
        $payload = ['user_id' => 5,
            'type' => 2,
            'price' => 130,
            'from' => '2020-11-11',
            'to' => '2020-10-10']
        ;
        $this->json('POST', 'api/subscriptions', $payload)
            ->assertStatus(400);
    }

    public function testSubscriptionStore()
    {
        $payload = ['user_id' => 5,
            'type' => 2,
            'price' => 130,
            'from' => '2020-10-10',
            'to' => '2020-11-11']
        ;
        $this->json('POST', 'api/subscriptions', $payload)
            ->assertStatus(200);
        $response = $this->json('GET', 'api/subscriptions');
        $response->assertJson(
            ['user_id' => 5,
                'type' => 2,
                'price' => 130,
                'from' => '2020-10-10',
                'to' => '2020-11-11']
        );
    }

    public function testPriceNotNegative()
    {
        $payload = ['user_id' => 5,
            'type' => 2,
            'price' => -130,
            'from' => '2020-10-10',
            'to' => '2020-11-11']
        ;
        $this->json('POST', 'api/subscriptions', $payload)
            ->assertStatus(400);
    }
}
