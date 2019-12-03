<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $hidden = [
        'id',
        'spot_id'
    ];
    
    protected $guarded = [
        'id',
        'spot_id'
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
        return $this->morphOne('App\Map', 'mappable');
    }
}
