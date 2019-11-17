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
     * @return void
     */
    public function testCan()
    {
        $user = factory(\App\User::class)->create();

        $spot = factory(\App\Spot::class)->create(['creator_id' => $user->id]);

        $response = $this->delete( "/spots/$spot->slug");

        if (!$response->assertStatus(200)) {
            \Log::info($response->json());
        }
    }
}
