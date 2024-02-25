<?php

namespace GustavoMorais\User\Tests\Feature;

use GustavoMorais\Tests\MainTestCase;
use GuzzleHttp\Client;

class MiddlewareTest extends MainTestCase
{
    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testRefreshToken()
    {
        $requestData = __DIR__ . '/../RequestData/Authentication.json';
        $requestData = json_decode(file_get_contents($requestData));

        $client = new Client();
        $response = $client->request('GET', 'http://localhost/api/users', [
            'headers' => [
                'Authorization' => "Bearer {$requestData->token}",
            ]
        ]);
        
        $content = json_decode($response->getBody()->getContents());
        $expectedResponse = __DIR__ . '/../Responses/GetUsers.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse));
        print_r(json_encode(['response' => $content, 'expected' => $expectedResponse]));echo "\n\n";exit;
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('success', $content->status);

        $data = json_decode(json_encode($content->data[0]), true);
        $this->assertContainsEquals('uuid', array_keys($data));
        $this->assertContainsEquals('first_name', array_keys($data));
        $this->assertContainsEquals('email', array_keys($data));
        $this->assertEquals($expectedResponse->data[0]->email, $content->data[0]->email);
    }
}
