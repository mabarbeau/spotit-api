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
        $attributes['creator_id'] = Auth::user()->id;

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
     * Sports available at spot
     */
    public function sport()
    {
        return $this->belongsToMany('App\Sport');
    }

    /**
     * Sports available at spot
     */
    public function creator()
    {
        return $this->hasOne('App\User');
    }
}
