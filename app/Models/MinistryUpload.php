<?php

namespace App\Models;

use Eloquent;

class MinistryUpload extends Eloquent
{
    protected $fillable = ['ext', 'size', 'name', 'title', 'path', 'url', 'disk', 'ministry_id', 'type',];

    public function ministries()
    {
        return $this->belongsTo(Ministry::class);
    }
}
