<?php

namespace Tests\Feature\Sports;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can delete a sport
     *
     * @dataProvider UserProvider
     *
     * @param \App\User $User
     * @return void
     */
    public function testCan(\App\User $user)
    {
        $sport = factory(\App\Sport::class)->create();

        $response = $this->actingAs($user)->delete( "/sports/$sport->name");

        if (!$response->assertStatus(200)) {
            \Log::info($response->json());
        }
    }
}
