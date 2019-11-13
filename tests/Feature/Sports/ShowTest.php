<?php

namespace Tests\Feature\Sports;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
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

        $response = $this->actingAs($user)->get("/sports/$sport->slug");

        $response->assertStatus(200);
    }
}
