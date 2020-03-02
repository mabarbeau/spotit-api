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

    public function for()
    {
        return $this->hasOne('App\User');
    }
}
