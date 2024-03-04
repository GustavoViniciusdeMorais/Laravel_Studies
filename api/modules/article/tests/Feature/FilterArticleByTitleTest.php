<?php

namespace GustavoMorais\Tests\Feature;

use GustavoMorais\Tests\MainTestCase;
use GuzzleHttp\Client;

class FilterArticleByTitleTest extends MainTestCase
{

    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testFilterArticles()
    {
        $client = new Client();
        $response = $client->request('POST', 'http://localhost/api/articles/filter', [
            'form_params' => [
                'title' => 'abc',
            ]
        ]);
        $content = json_decode($response->getBody()->getContents());
        print_r(json_encode(['content' => $content]));echo "\n\n";
        $this->assertEquals('200', $response->getStatusCode());
        if (isset($content->status)) {
            $this->assertEquals('success', $content->status);
        }
    }
}
