<?php

namespace App\Models;

use App\User;
use Eloquent;

class Claim extends Eloquent
{
    protected $fillable = ['user_id', 'ministry_id', 'url', 'approved'];

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
