<?php

namespace Tests\Feature\Sports;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can list sports
     *
     * @return void
     */
    public function testCan()
    {
        $response = $this->get('/sports');

        $response->assertStatus(200);
    }
}
