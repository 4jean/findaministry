<?php

namespace App\Models;

use Eloquent;

class MinBookmark extends Eloquent
{
    protected $fillable = ['user_id', 'ministry_id'];

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }
}
