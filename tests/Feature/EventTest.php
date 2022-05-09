<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event_initial_display()
    {
        $response = $this->get('/event');

        $response->assertStatus(200);
        $response->assertSeeText('人気イベント');
        $response->assertSeeText('イベントが登録されていません。');
    }

    public function test_event_over_five()
    {
        User::factory(10)->create();
        Event::factory(6)->create();
        
        $response = $this->get('/event');
        $response->assertSeeText('閲覧するには会員登録が必要です。');
        
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'privacy_policy' => '1',
        ]);
        $response = $this->get('/event');
        $response->assertDontSeeText('閲覧するには会員登録が必要です。');
    }
}
