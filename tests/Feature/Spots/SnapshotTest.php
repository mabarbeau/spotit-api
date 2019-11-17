<?php

namespace Tests\Feature\Spots;

use App\Spot;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SnapshotTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Creating and updating takes snapshots
     * 
     * @param \App\Spot $spot
     * @return void
     */
    public function testCreateAndUpdateMakeSnapshots()
    {
        $user = factory(\App\User::class)->create();

        $spot = factory(\App\Spot::class)->create(['creator_id' => $user->id]);

        // Creating a spot takes a snapshot
        $this->assertEquals($spot->snapshots()->where('event', 'created')->count(), 1);
        
        $newData = factory(Spot::class)->make()->toArray();
        
        // Updating a spot takes a snapshot
        $spot->update($newData);
        
        $this->assertEquals($spot->snapshots()->where('event', 'updated')->count(), 1);
    }
}
