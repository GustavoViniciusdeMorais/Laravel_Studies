<?php

namespace GustavoMorais\Tests\Feature;

use GustavoMorais\Article\Providers\ArticleProvider;

class GetArticlesTest extends \Orchestra\Testbench\TestCase
{
    // Use annotation @test so that PHPUnit knows about the test
    /** @test */
    public function visit_test_route()
    {
        // Visit /test and see "Test Laravel package isolated" on it
        $response = $this->get('test');
        $response->assertStatus(200);
        $response->assertSee('Test Laravel package isolated');
    }

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            ArticleProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
