<?php

namespace App\Http\Controllers;

use App\Repositories\GuideRepo;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    protected $guide;
    public function __construct(GuideRepo $guide)
    {
        $this->guide = $guide;
    }

    public function index()
    {
        $data['page_title'] = 'Guides';
        $data['body_class'] = 'page-sub-page page-blog-listing';

        return view('pages.guides.index', $data);
    }

    public function verify_ministry()
    {
        $data['page_title'] = 'How to Verify a Ministry';

        $data['md'] = 'You can Claim A Ministry by visiting the Ministry Page. If The Ministry is yet to be claimed or verified. A Button will be displayed tagged Verify or Claim This Ministry, otherwise if the Ministry has been Claimed by someone else and you know the Ministry belongs to you, please Contact us.';

        return view('pages.guides.verify_ministry', $data);
    }

    public function set_page_name()
    {
        $data['page_title'] = 'Choosing A Ministry Page Name';
        $data['md'] = 'Ministry Page Names are intended to make it easier for people to find your Ministry pages and share with others. As a reputable Ministry, you can choose a unique Ministry URL that is easy to remember.';

        return view('pages.guides.set_page_name', $data);
    }
}
