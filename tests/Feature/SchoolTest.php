<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchoolTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_school_initial_display()
    {
        $response = $this->get('/school');

        $response->assertStatus(200);
        $response->assertSeeText('開講情報・レビュー');
        $response->assertSeeText('スクールが登録されていません。');
    }

    public function test_school_over_ten()
    {
        $schools = School::factory(11)->create();
        
        $response = $this->get('/school');
        $response->assertSeeText('閲覧するには会員登録が必要です。');
        
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'privacy_policy' => '1',
        ]);
        $response = $this->get('/school');
        $response->assertDontSeeText('閲覧するには会員登録が必要です。');
    }

    
}
