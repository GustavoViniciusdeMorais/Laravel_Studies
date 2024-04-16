<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetAccountByIdTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetAccountById()
    {
        $expectedResponse = __DIR__ . '/../Responses/GetAccountById.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse), true);
        $response = $this->get('/api/accounts?id=1');
        $response->assertStatus(200)
            ->dump()
            ->assertJsonFragment($expectedResponse);
    }
}
