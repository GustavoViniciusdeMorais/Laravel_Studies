<?php

namespace GustavoMorais\Tests\Feature;

use GustavoMorais\Tests\MainTestCase;
use GuzzleHttp\Client;

class GetArticlesTest extends MainTestCase
{

    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function testGetArticles()
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost/api/articles');
        $this->assertEquals('200', $response->getStatusCode());
    }
}
