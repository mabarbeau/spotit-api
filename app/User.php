<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Traits\UsesUuid;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'picture',
    ];
    protected $guarded = [
        'id'
    ];

    public function spots()
    {
        return $this->hasMany('App\Spot', 'creator_id');
    }
    
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
    
    public function accounts()
    {
        return $this->hasMany('App\Account')->orderBy('updated_at');
    }
}
