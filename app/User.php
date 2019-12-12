<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Traits\UsesUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];
    protected $hidden = ['id'];
    protected $guarded = [
        'id'
    ];

    public function spots()
    {
        return $this->hasMany('App\Spot', 'creator_id');
    }
    
}
