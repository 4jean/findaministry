<?php

namespace App\Http\Controllers;

use App\Mail\Claims\ClaimRequest;
use App\Mail\ContactForm;
use App\MyHelper\Fam;
use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        $data = ["name" => "Chinedu Okemiri", "email" => "jokemiri@outlook.com", "message" => "This is my message. What is your problem"];

return Carbon::now()->toDayDateTimeString();
    }
}
