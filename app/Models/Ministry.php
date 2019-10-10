<?php

namespace App\Models;

use Eloquent;

class Ministry extends Eloquent
{
    protected $fillable = ['user_id', 'code', 'phone1', 'phone2', 'postal_code', 'name', 'email', 'website', 'fb', 'address', 'city', 'state', 'country', 'country_code', 'min_cat_id', 'founder', 'hq', 'visits', 'verified', 'description','photo', 'page', 'url', 'yt', 'tw', 'inst', ];

    public function uploads()
    {
        return $this->hasMany(MinistryUpload::class);
    }

    public function bookmark()
    {
        return $this->hasMany(MinBookmark::class);
    }

    public function min_cat()
    {
        return $this->belongsTo(MinCat::class);
    }

    public function claim()
    {
        return $this->hasMany(Claim::class);
    }
}
