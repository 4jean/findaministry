<?php

namespace App\Repositories;


use App\Models\Guide;

class GuideRepo
{
    public function all()
    {
        return Guide::orderBy('created_at', 'desc');
    }
}