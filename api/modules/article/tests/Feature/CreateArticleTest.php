<?php

namespace GustavoMorais\Tests\Feature;

use GustavoMorais\Tests\MainTestCase;
use GuzzleHttp\Client;

class CreateArticleTest extends MainTestCase
{

    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testCreateArticle()
    {
        $client = new Client();
        $response = $client->request('POST', 'http://localhost/api/articles', [
            'form_params' => [
                'title' => 'test',
                'body' => 'test',
            ]
        ]);
        
        $content = json_decode($response->getBody()->getContents());
        $expectedResponse = __DIR__ . '/../Responses/CreateArticle.json';
        $expectedResponse = json_decode(file_get_contents($expectedResponse));
        print_r(json_encode(['expected' => $expectedResponse, 'actual' => $content]));echo "\n\n";
        $this->assertEquals('200', $response->getStatusCode());
        if (
            isset($content->status)
            && isset($content->data->title)
        ) {
            $this->assertEquals('success', $content->status);
            $this->assertEquals($expectedResponse->data[0]->title, $content->data->title);
        }
    }
}
