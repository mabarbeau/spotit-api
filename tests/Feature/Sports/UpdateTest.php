<?php

namespace Tests\Feature\Sports;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
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

        $key = (new \App\Sport)->getRouteKeyName();
        
        $response = $this->actingAs($user)->put(
            "/sports/" . $sport->$key,
            $sport = factory(\App\Sport::class)->make()->toArray()
        );

        $response->assertStatus(200);
    }
}
