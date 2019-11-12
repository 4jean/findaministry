<?php

namespace App\Http\Controllers;

use App\Mail\Claims\ClaimRequest;
use App\Mail\ContactForm;
use App\MyHelper\Fam;
use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    protected $request, $min;

    public function __construct(Request $request, MinistryRepo $min)
    {
        $this->request = $request;
        $this->min = $min;
    }

    public function index()
    {
        $url = 'http://findaministry.com/SM3279';
       return str_replace('http', 'https', $url);

    }
}
