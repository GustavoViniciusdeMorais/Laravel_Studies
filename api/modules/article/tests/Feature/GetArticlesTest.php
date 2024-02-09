<?php

namespace GustavoMorais\Tests\Feature;

use GustavoMorais\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetArticlesTest extends TestCase
{
    use RefreshDatabase;

    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testGetArticles()
    {
        // $response = $this->get('api/articles');

        // $response->assertStatus(200);
        // $response->assertJson([
        //     'success' => true,
        //     // Add more assertions based on the expected response structure
        // ]);
        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, 'http://localhost/api/articles'); // Replace 'http://your-api-domain' with your actual API domain
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL request
        $response = curl_exec($ch);
    }
}
