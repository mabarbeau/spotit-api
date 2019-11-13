<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $hidden = ['id'];
    protected $guarded = [
        'id'
    ];
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Snapshots of spot
     */
    public function snapshots()
    {
        return $this->morphMany('App\Snapshot', 'snapshotable');
    }

}
