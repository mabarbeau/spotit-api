<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $hidden = ['id'];
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
        return 'slug';
    }

    public function snapshots()
    {
        return $this->morphMany('App\Snapshot', 'snapshotable');
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
