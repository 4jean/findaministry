<?php

namespace App\Http\Controllers;

use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;

class MinCatController extends Controller
{

    protected $min;
    protected $request;

    public function __construct(Request $request, MinistryRepo $min)
    {
        $this->request = $request;
        $this->min = $min;
    }

    public function index($slug = null)
    {
        if($slug){
            $min_cats= $this->min->getAllCats();
            if($min_cats->contains('slug', $slug)){

                $min_cat = $min_cats->where('slug', $slug);
                $min_cat_id = $min_cat->pluck('id')->first();

                $min_cat_name = $min_cat->pluck('name')->first();

                $data['mins'] = $this->min->findByField(['min_cat_id' => $min_cat_id])->paginate(20);
                $data['page_title'] = $min_cat_name. ' Ministries';
                $data['min_cat_name'] = $min_cat_name;
                $data['md'] = 'Find Ministries by Category. Find and Connect with '.$min_cat_name.' Ministries Nationwide';

                return view('pages.ministry.show_category', $data);

            }

        }
        $data['page_title'] = 'Ministry Categories';

        return view('pages.ministry.categories', $data);
    }

}
