<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $hidden = ['id'];
    protected $guarded = [
        'id'
    ];

    /**
     * Spots for sport
     */
    public function spot()
    {
        return $this->hasOne('App\Spot');
    }
    
    /**
     * Snapshots of spot
     */
    public function map()
    {
        return $this->morphOne('App\Snapshot', 'mappable');
    }
}
