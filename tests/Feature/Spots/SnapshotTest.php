<?php

namespace Tests\Feature\Spots;

use App\Spot;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SnapshotTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * Can delete a spot
     * 
     * @param Spot
     * @return void
     */
    public function testCreateAndUpdateMakeSnapshots()
    {
        // Creating a spot takes a snapshot
        $spot =factory(Spot::class)->create();

        $newData = factory(Spot::class)->make()->toArray();

        // Updating a spot takes a snapshot
        $spot->update($newData);

        $this->assertEquals(2, $spot->snapshots()->count());
    }
}
