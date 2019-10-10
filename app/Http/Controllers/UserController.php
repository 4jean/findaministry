<?php

namespace App\Http\Controllers;

use App\Repositories\MinistryRepo;
use App\Repositories\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $request;
    protected $user;
    protected $min;

    public function __construct(Request $request, UserRepo $user, MinistryRepo $min)
    {
        $this->request = $request;
        $this->user = $user;
        $this->min = $min;
    }

    public function my_profile()
    {
        $data['body_class'] = 'page-sub-page page-profile page-account';
        $data['page_title'] = 'My Profile';

        return view('pages.user.my_profile', $data);

    }

    public function my_ministries()
    {
        $data['body_class'] = 'page-sub-page page-my-properties page-account
';
        $data['page_title'] = 'My Ministries';
        $data['ministries'] = $this->min->getMyMinistries();

        return view('pages.user.my_ministries', $data);
    }

    public function my_bookmarks()
    {
        $data['page_title'] = 'My Bookmarks';
        $data['mins'] = $this->min->getMyMinBookmarks()->paginate(30);

        return view('pages.user.my_bookmarks', $data);
    }

    public function update_profile()
    {
        $id = $this->request->user()->id;
        $this->request->validate([
            'email' => 'required|email|max:100|unique:users,id,'.$id,
            'phone' => 'required|min:8|string|max:15'
        ]);
        $data = $this->request->only('email', 'phone');
        $data['email_verified_at'] = NULL;
        $this->user->update(Auth::user()->id, $data);
        $this->request->session()->flash('flash_success', 'Account Updated Successfuly');
        return redirect()->route('my_account');

    }

    public function update_password()
    {
        $this->request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|max:50|confirmed',
        ]);

        $data = $this->request->only('current_password', 'password');
        if(password_verify($data['current_password'], Auth::user()->password)){
            $data['password'] = bcrypt($data['password']);
            $this->user->update(Auth::user()->id, ['password' => $data['password']]);
            $this->request->session()->flash('flash_success', 'Password Updated Successfuly');
        }

        return redirect()->route('my_account');
    }
}
