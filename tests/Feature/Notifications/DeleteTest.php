<?php

namespace Tests\Feature\Notifications;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can delete a notification
     * 
     * @return void
     */
    public function testCan()
    {
        $user = factory(\App\User::class)->create();

        $notification = factory(\App\Notification::class)->create(['user_id' => $user->id]);

        $response = $this->delete( "/notifications/$notification->id");

        if (!$response->assertStatus(200)) {
            Log::info($response->json());
        }
    }
}
