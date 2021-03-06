<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;

class HomeController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user)
    {
        $this->user =$user;
    }

    public function index()
    {
        $data['users'] = $this->user->all();
        return view('admin.pages.index', $data);
    }
}
