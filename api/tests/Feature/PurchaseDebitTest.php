<?php

namespace Tests\Feature;

use Tests\TestCase;

class PurchaseDebitTest extends TestCase
{
    public function testPurchaseDebit()
    {
        $expectedResponse = __DIR__ . '/../Responses/PurchaseDebit.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse), true);

        $data = [
            "payment_type" => "D",
            "account_id" => 1,
            "value" => 50
        ];

        $response = $this->post('/api/transactions', $data);
        $response->assertStatus(201)
            ->dump()
            ->assertJsonFragment($expectedResponse);
    }
}
