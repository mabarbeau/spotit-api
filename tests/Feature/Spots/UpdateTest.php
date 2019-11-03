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
     * @dataProvider UserProvider
     *
     * @param \App\User $User
     * @return void
     */
    public function testCan(\App\User $user)
    {
        $spot = factory(\App\Spot::class)->create();
        
        $response = $this->actingAs($user)->put(
            "/spots/" . $spot->slug,
            $spot = factory(\App\Spot::class)->make()->toArray()
        );

        $response->assertStatus(200);
    }
}
