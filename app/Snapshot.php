<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Snapshot extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public $timestamps = false;

    public static function create(Model $model)
    {
        $key = $model->primaryKey;

        return static::query()->create([
            'key' => $model->$key,
            'class' => get_class($model),
            'json' => json_encode($model),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}