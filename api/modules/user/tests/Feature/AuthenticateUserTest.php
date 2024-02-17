<?php

namespace GustavoMorais\Tests\Feature;

use GustavoMorais\Tests\MainTestCase;
use GuzzleHttp\Client;

class AuthenticateUserTest extends MainTestCase
{

    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testAuthenticateUser()
    {
        
        $client = new Client();
        $response = $client->request('POST', 'http://localhost/api/users/login', [
            'form_params' => [
                'email' => 'test@email.com',
                'password' => '7@&5bk5',
            ]
        ]);
        
        $content = json_decode($response->getBody()->getContents());
        $expectedResponse = __DIR__ . '/../Responses/AuthenticateUser.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse));
        
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('success', $content->status);

        $data = json_decode(json_encode($content->data), true);
        $this->assertContainsEquals('token', array_keys($data));
    }
}
