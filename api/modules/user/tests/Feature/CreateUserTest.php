<?php

namespace GustavoMorais\Tests\Feature;

use GustavoMorais\Tests\MainTestCase;
use GuzzleHttp\Client;

class CreateUserTest extends MainTestCase
{

    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testCreateUser()
    {
        $client = new Client();
        $response = $client->request('POST', 'http://localhost/api/users', [
            'form_params' => [
                'first_name' => 'test',
                'last_name' => 'test',
                'email' => 'test@email.com',
                'password' => '7@&5bk5',
            ]
        ]);
        
        $content = json_decode($response->getBody()->getContents());
        $expectedResponse = __DIR__ . '/../Responses/CreateUser.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse));
        
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('success', $content->status);
        $this->assertEquals($expectedResponse->data[0]->first_name, $content->data->first_name);
    }
}
