<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class TopTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    //  ユーザーでログインした時の表示
    public function test_display()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('企業情報・選考情報');

        $response = $this->get('/');
        $response->assertDontSeeText('Admin Header');
    }

    // 管理者でログインしたときの表示
    public function test_admin_display()
    {
        $user = User::factory()->create();
        $user->admin_flg = 1;
        $user->save();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'privacy_policy' => '1',
        ]);

        $response = $this->get('/');
        $response->assertSeeText('Admin Header');
    }
}
