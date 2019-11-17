<?php

namespace Tests\Feature\Spots;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can create a new spot
     * 
     * @return void
     */
    public function testCan()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->post(
            "/spots",
            factory(\App\Spot::class)->make()->toArray()
        );
        if(!$response->assertStatus(201)) {            
            \Log::info($response->json());
        }
    }
}
