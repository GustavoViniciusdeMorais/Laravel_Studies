<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);
        $data = [
            'title' => 'Gustavo',
            'content' => 'Vinicius'
        ];

        $expected = ['title' => 'Gustavo'];

        // the dump function shows the code error at console.
        // the assertJsonFragment allows you to build a more flexible test.

        $this->post(route('articles.create'), $data)
            ->dump()
            ->assertStatus(201)
            ->assertJsonFragment($expected);
    }
}
