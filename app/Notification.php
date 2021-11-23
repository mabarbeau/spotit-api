<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use Traits\UsesUuid;

    protected $fillable = [
        'message', 'type', 'read'
    ];
    protected $protected = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the user's first name.
     *
     * @param  int  $value
     * @return boolean
     */
    public function getReadAttribute($value)
    {
        return $value ? true : false;
    }


    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }
}
