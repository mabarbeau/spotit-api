<?php

namespace Tests\Feature\Spots;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can delete a spot
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
