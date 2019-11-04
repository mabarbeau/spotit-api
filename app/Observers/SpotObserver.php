<?php

namespace App\Observers;

use App\Spot;
use App\Snapshot;

class SpotObserver
{
    /**
     * Handle the spot "created" event.
     *
     * @param  \App\Spot  $spot
     * @return void
     */
    public function created(Spot $spot)
    {
        \Log::info('created');
        \Log::info(Snapshot::create('created', $spot));
    }

    /**
     * Handle the spot "updated" event.
     *
     * @param  \App\Spot  $spot
     * @return void
     */
    public function updated(Spot $spot)
    {
        \Log::info('updated');
        \Log::info(Snapshot::create('updated', $spot));
    }
}
