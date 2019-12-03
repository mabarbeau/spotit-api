<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $hidden = ['id', 'pivot'];
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
        return 'name';
    }

    /**
     * Spots for sport
     */
    public function spots()
    {
        return $this->belongsToMany('App\Spot');
    }

}
