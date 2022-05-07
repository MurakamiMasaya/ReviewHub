<?php

namespace Tests\Feature;

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
    public function test_school_display()
    {
        $response = $this->get('/school');

        $response->assertStatus(200);
        $response->assertSeeText('開講情報・レビュー');
    }
}
