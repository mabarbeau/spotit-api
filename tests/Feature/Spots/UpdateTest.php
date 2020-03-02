<?php

namespace Tests\Feature\Spots;

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
    public function testSpotUpdateCreatesNewRecordInTheUpdatesTable()
    {
        $user = factory(\App\User::class)->create();

        $spot = factory(\App\Spot::class)->create(['creator_id' => $user->id]);
        
        $response = $this->actingAs($user)->put(
            "/spots/" . $spot->slug,
            factory(\App\Spot::class)->make()->toArray()
        );

        $this->assertDatabaseHas('updates', [
            'updatable_id' => $spot->id,
            'updatable_type' => 'App\Spot',
            'status' => 'pending',
            'creator_id' => $user->id,
        ]);

        $response->assertStatus(200);
    }
}
