<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $fillable = [
        'provider', 'account_id',
    ];

    /**
     * Sports available at spot
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
