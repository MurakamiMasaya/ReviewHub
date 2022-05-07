<?php

namespace Tests\Feature;

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
    public function test_company_display()
    {
        $response = $this->get('/company');

        $response->assertStatus(200);
        $response->assertSeeText('企業情報・選考情報');
    }
}
