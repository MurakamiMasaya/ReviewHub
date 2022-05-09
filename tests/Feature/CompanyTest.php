<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_company_initial_display()
    {
        $response = $this->get('/company');

        $response->assertStatus(200);
        $response->assertSeeText('企業情報・選考情報');
        $response->assertSeeText('企業が登録されていません。');
    }

    public function test_company_over_ten()
    {
        $companies = Company::factory(11)->create();
        
        $response = $this->get('/company');
        $response->assertSeeText('閲覧するには会員登録が必要です。');

        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'privacy_policy' => '1',
        ]);
        $response = $this->get('/company');
        $response->assertDontSeeText('閲覧するには会員登録が必要です。');
    }
}
