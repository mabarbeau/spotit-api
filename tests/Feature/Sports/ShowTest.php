<?php

namespace Tests\Feature\Sports;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     * 
     * @return void
     */
    public function testCan()
    {
        $user = factory(\App\User::class)->create();
        
        $sport = factory(\App\Sport::class)->create();

        $response = $this->actingAs($user)->get("/sports/$sport->slug");

        $response->assertStatus(200);
    }
}
