<?php

namespace GustavoMorais\Tests\Feature;

use GustavoMorais\Tests\MainTestCase;
use GuzzleHttp\Client;

class RefreshTokenTest extends MainTestCase
{
    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testRefreshToken()
    {
        $requestData = __DIR__ . '/../RequestData/Authentication.json';
        $requestData = json_decode(file_get_contents($requestData));

        $client = new Client();
        $response = $client->request('GET', 'http://localhost/api/users/refresh', [
            'headers' => [
                'Authorization' => "Bearer {$requestData->refresh_token}",
            ]
        ]);
        
        $content = json_decode($response->getBody()->getContents());
        $expectedResponse = __DIR__ . '/../Responses/VerifyJwt.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse));
        
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('success', $content->status);

        $data = json_decode(json_encode($content->data), true);
        $this->assertContainsEquals('token', array_keys($data));
        $this->assertContainsEquals('refresh_token', array_keys($data));
        $this->assertContainsEquals('email', array_keys($data));
        $this->assertEquals($expectedResponse->data[0]->email, $content->data->email);
    }
}
