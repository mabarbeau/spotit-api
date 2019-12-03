<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Map extends Model
{
    use SpatialTrait;

    protected $hidden = [
        'id',
        'mappable_id',
        'mappable_type',
    ];

    protected $guarded = [
        'id',
    ];

    protected $spatialFields = [
        'geometry',
    ];

    public function mappable()
    {
        return $this->morphTo();
    }
}
