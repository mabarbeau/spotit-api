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

    public function snapshotable()
    {
        return $this->morphTo();
    }

    public static function create($event, Model $model)
    {
        $key = $model->primaryKey;

        return static::query()->create([
            'snapshotable_id' => $model->$key,
            'snapshotable_type' => get_class($model),
            'event' => $event,
            'json' => json_encode($model),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}