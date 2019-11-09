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
     * @return void
     */
    public function testCreateAndUpdateMakeSnapshots()
    {
        // Creating a spot takes a snapshot
        $spot =factory(Spot::class)->create();

        $this->assertEquals($spot->snapshots()->where('event', 'created')->count(), 1);
        
        $newData = factory(Spot::class)->make()->toArray();
        
        // Updating a spot takes a snapshot
        $spot->update($newData);
        
        $this->assertEquals($spot->snapshots()->where('event', 'updated')->count(), 1);
    }
}
