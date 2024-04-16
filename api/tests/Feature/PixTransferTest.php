<?php

namespace Tests\Feature;

use Tests\TestCase;

class PixTransferTest extends TestCase
{
    public function testPixTransfer()
    {
        $expectedResponse = __DIR__ . '/../Responses/PixTransfer.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse), true);

        $data = [
            "payment_type" => "P",
            "account_id" => 1,
            "value" => 75
        ];

        $response = $this->post('/api/transactions', $data);
        $response->assertStatus(201)
            ->dump()
            ->assertJsonFragment($expectedResponse);
    }
}
