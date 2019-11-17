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
    public function testCan()
    {
        $user = factory(\App\User::class)->create();

        $spot = factory(\App\Spot::class)->create(['creator_id' => $user->id]);
        
        $response = $this->actingAs($user)->put(
            "/spots/" . $spot->slug,
            $spot = factory(\App\Spot::class)->make()->toArray()
        );

        $response->assertStatus(200);
    }
}
