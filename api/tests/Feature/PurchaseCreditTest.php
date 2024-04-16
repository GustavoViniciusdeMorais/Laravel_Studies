<?php

namespace Tests\Feature;

use Tests\TestCase;

class PurchaseCreditTest extends TestCase
{
    public function testPurchaseCredit()
    {
        $expectedResponse = __DIR__ . '/../Responses/PurchaseCredit.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse), true);

        $data = [
            "payment_type" => "D",
            "account_id" => 1,
            "value" => 100
        ];

        $response = $this->post('/api/transactions', $data);
        $response->assertStatus(201)
            ->dump()
            ->assertJsonFragment($expectedResponse);
    }
}
