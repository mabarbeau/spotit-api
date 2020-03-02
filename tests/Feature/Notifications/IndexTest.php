<?php

namespace Tests\Feature\Notifications;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can list notifications
     *
     * @return void
     */
    public function testCan()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get('/notifications');

        $response->assertStatus(200);
    }
}
