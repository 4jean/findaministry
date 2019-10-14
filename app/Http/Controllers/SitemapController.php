<?php

namespace App\Http\Controllers;


use App\MyHelper\Fam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{

    protected  $path;
    public function __construct()
    {
        $this->path = Storage::disk('public')->path('sitemap.xml');
    }

    public function index()
    {
        return Fam::userIsAdmin() ? $this->generate() : $this->show();
    }

    public function generate()
    {
        SitemapGenerator::create('http://findaministry.com')->writeToFile($this->path);
    }

    public function show()
    {
        return response()->file($this->path);
    }

}
