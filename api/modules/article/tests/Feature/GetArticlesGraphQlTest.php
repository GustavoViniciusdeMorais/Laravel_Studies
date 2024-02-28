<?php

namespace GustavoMorais\Article\Tests\Feature;

use GustavoMorais\Tests\MainTestCase;
use GuzzleHttp\Client;

class GetArticlesGraphQlTest extends MainTestCase
{
    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testGetArticles()
    {
        $client = new Client();
        $query = <<<GRAPHQL
            {
                getArticles {
                    uuid
                    title
                    body
                }
            }
        GRAPHQL;
        $response = $client->request('POST', 'http://localhost/api/articles/graphql', [
            'json' => [
                'query' => $query,
            ]
        ]);
        $content = json_decode($response->getBody()->getContents());
        echo "\n";
        print_r(json_encode(['response' => $content]));echo "\n";
        $this->assertEquals('200', $response->getStatusCode());
        if (isset($content->status)) {
            $this->assertEquals('success', $content->status);
        }
    }
}
