<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateAccountTest extends TestCase
{
    public function testCreateAccount()
    {
        $expectedResponse = __DIR__ . '/../Responses/CreateAccount.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse), true);

        $data = [
            "email" => "john@example.com",
            "balance" => 500,
        ];

        $response = $this->post('/api/accounts', $data);
        $response->assertStatus(201)
            ->dump()
            ->assertJsonFragment($expectedResponse);
    }
}
