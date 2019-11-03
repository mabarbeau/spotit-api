<?php

namespace Tests\Feature\Spots;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can list spots
     *
     * @return void
     */
    public function testCan()
    {
        $response = $this->get('/spots');

        $response->assertStatus(200);
    }
}
