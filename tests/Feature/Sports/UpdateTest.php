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
     * @dataProvider UserProvider
     *
     * @param \App\User $User
     * @return void
     */
    public function testCan(\App\User $user)
    {
        $sport = factory(\App\Sport::class)->create();

        $key = (new \App\Sport)->getRouteKeyName();
        
        $response = $this->actingAs($user)->put(
            "/sports/" . $sport->$key,
            $sport = factory(\App\Sport::class)->make()->toArray()
        );

        $response->assertStatus(200);
    }
}
