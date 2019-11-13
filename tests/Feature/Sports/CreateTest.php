<?php

namespace Tests\Feature\Sports;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can create a new sport
     *
     * @dataProvider UserProvider
     *
     * @param \App\User $user
     * @return void
     */
    public function testCan(\App\User $user)
    {
        $response = $this->actingAs($user)->post(
            "/sports",
            factory(\App\Sport::class)->make()->toArray()
        );
        if(!$response->assertStatus(201)) {            
            \Log::info($response->json());
        }
    }
}
