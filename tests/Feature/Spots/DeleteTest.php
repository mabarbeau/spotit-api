<?php

namespace Tests\Feature\Spots;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @dataProvider UserProvider
     *
     * @param \App\User $User
     * @return void
     */
    public function testCan(\App\User $user)
    {
        $spot = factory(\App\Spot::class)->create();

        $response = $this->actingAs($user)->delete( "/spots/$spot->slug");

        if (!$response->assertStatus(200)) {
            \Log::info($response->json());
        }
    }
}
