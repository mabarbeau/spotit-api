<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    /**
     * Turn off auto incrementing primary key
     *
     * @var boolean
     */
    public $incrementing = false;

    protected $guarded = [
        'id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getKeyType()
    {
        return 'string';
    }

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
