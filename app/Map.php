<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Map extends Model
{
    use SpatialTrait;

    protected $guarded = [
        'id'
    ];

    public function mappable()
    {
        return $this->morphTo();
    }
}
