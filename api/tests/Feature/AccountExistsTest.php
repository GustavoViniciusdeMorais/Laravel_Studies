<?php

namespace Tests\Feature;

use Tests\TestCase;

class AccountExistsTest extends TestCase
{
    /**
     * @return void
     */
    public function testAccountExists()
    {
        $response = $this->get('/api/accounts?id=102');
        $response->assertStatus(404)
            ->dump();
    }
}
