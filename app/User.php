<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * Turn off auto incrementing primary key
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
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

    public function spots()
    {
        return $this->hasMany('App\Spot', 'creator_id');
    }
    
}
