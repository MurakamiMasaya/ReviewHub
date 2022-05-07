<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_article_display()
    {
        $response = $this->get('/article');

        $response->assertStatus(200);
        $response->assertSeeText('人気特集記事');
    }
}
