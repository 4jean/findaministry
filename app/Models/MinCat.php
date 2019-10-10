<?php

namespace App\Models;

use Eloquent;

class MinCat extends Eloquent
{
    public function ministry()
    {
        return $this->hasMany(Ministry::class);
    }
}
