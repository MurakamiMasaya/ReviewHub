<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
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
    public function test_article_initial_display()
    {
        $response = $this->get('/article');

        $response->assertStatus(200);
        $response->assertSeeText('人気特集記事');
        $response->assertSeeText('記事が登録されていません。');
    }

    public function test_article_over_five()
    {
        User::factory(10)->create();
        Article::factory(6)->create();
        
        $response = $this->get('/article');
        $response->assertSeeText('閲覧するには会員登録が必要です。');
        
        $user = User::factory()->create();
        
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'privacy_policy' => '1',
        ]);
        $response = $this->get('/article');
        $response->assertDontSeeText('閲覧するには会員登録が必要です。');
    }
}
