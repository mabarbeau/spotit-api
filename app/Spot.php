<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $hidden = ['id'];
    protected $guarded = [
        'id'
    ];

    public static function create(array $attributes = [])
    {
        $attributes['creator_id'] = User::first()->id; // TODO:  Auth::user()->id

        return static::query()->create($attributes);
    }
    
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

    /**
     * Snapshots of spot
     */
    public function map()
    {
        return $this->morphOne('App\Map', 'mappable');
    }

    /**
     * Sports available at spot
     */
    public function sport()
    {
        return $this->belongsToMany('App\Sport');
    }

    /**
     * Spots for sport
     */
    public function features()
    {
        return $this->hasMany('App\Feature');
    }

    /**
     * Sports available at spot
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }
}
