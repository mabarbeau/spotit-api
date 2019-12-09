<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use Traits\UsesUuid;

    protected $guarded = [
        'id'
    ];

    public function updatable()
    {
        return $this->morphTo();
    }

    /**
     * Sports available at spot
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }
}
