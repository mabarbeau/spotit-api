<?php

namespace Tests\Feature\Notifications;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can create a new notification
     * 
     * @return void
     */
    public function testCan()
    {
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->post(
            "/notifications",
            factory(\App\Notification::class)->make()->toArray()
        );
        if(!$response->assertStatus(201)) {            
            Log::info($response->json());
        }
    }
}
