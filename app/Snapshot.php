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

    /**
     * Restore from snapshot
     *
     * @param  Request  $request
     * @return Illuminate\Database\Eloquent\Model
     * @throws Exception Snapshot could not be restored
     */
    protected function restore()
    {
        if (class_exists($this->snapshotable_type)) {
            return $this->snapshotable_type::create($this->json());
        }
        throw new Exception("Snapshot could not be restored", 1);
    }
}