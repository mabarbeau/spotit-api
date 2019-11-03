<?php

namespace Tests\Feature\Spots;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Create a new spot with api
     *
     * @dataProvider UserProvider
     *
     * @param \App\User $user
     *
     * @return void
     */
    public function testCan(\App\User $user)
    {
        $response = $this->actingAs($user)->post(
            "/spots",
            factory(\App\Spot::class)->make()->toArray()
        );
        if(!$response->assertStatus(201)) {            
            \Log::info($response->json());
        }
    }
}
