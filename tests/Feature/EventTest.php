<?php

namespace Tests\Feature;

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
    public function test_event_display()
    {
        $response = $this->get('/event');

        $response->assertStatus(200);
        $response->assertSeeText('人気イベント');
    }
}
