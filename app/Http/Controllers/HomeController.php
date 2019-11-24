<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\MyHelper\Fam;
use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    protected $min, $request;

    public function __construct(Request $request, MinistryRepo $min)
    {
        $this->request = $request;
        $this->min = $min;
    }

    public function index()
    {
        $data['md'] = 'FIND A MINISTRY is a Platform for Finding Churches, Ministers, and Ministries and Helping them to Find You and Yours. Show your Ministry! Find Ministries!! Connect to Ministries. We live in a world sworn to dismantle all barriers to information, connectivity, and information (or idea) sharing.';

        $data['body_class'] = 'page-homepage page-slider page-slider-search-box';
        $data['page_title'] = 'Home';
        $data['random_mins'] = $this->min->getRandomMinistries();

        return view('home', $data);
    }

    public function about()
    {
        $data['page_title'] = 'About Us';
        $data['md'] = 'FIND A MINISTRY is a Platform for Finding Churches, Ministers, and Ministries and Helping them to Find You and Yours. Show your Ministry! Find Ministries!! Connect to Ministries. We live in a world sworn to dismantle all barriers to information, connectivity, and information (or idea) sharing.';

        return view('pages.about-us', $data);
    }

    public function contact()
    {
        $data['page_title'] = 'Contact Us';
        $data['md'] = 'FIND A MINISTRY, P.O. Box 59, Karu 900008, Abuja. Nigeria. For enquiries and more Information, you can connect with us on our Facebook Page @findaministry or call 07068149559, 08027444825.';

        return view('pages.contact', $data);
    }

    public function privacy_policy()
    {
        $data['page_title'] = 'Privacy Policy';
        return view('pages.privacy_policy', $data);
    }

    public function terms_of_use()
    {
        $data['page_title'] = 'Terms and Conditions';
        return view('pages.terms_of_use', $data);
    }

    public function contact_form()
    {
        $this->request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|max:100',
            'message' => 'required|string|between:20,350',
            'captcha'=>'required|captcha'
        ], ['captcha' => 'Invalid Captcha, Please Verify That you are Human'], ['captcha' => 'Captcha']);

         $data = $this->request->only(['name', 'email', 'message']);

        /* Send Email to Administrator */
        Mail::to(Fam::getSetting('system_email'))->send(new ContactForm($data));

        return back()->with('flash_success', 'Your Message Has Been Received. You will get a response shortly.');
    }
}
