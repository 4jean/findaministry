<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;

class CJUserController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user)
    {
        $this->user =$user;
    }

    public function index()
    {
        $data['users'] = $this->user->all();
        return view('admin.pages.user.index', $data);
    }

    public function delete($id)
    {
        return $this->user->destroy($id);
    }
}
