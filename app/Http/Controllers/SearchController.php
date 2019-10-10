<?php

namespace App\Http\Controllers;

use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;
use App\MyHelper\Fam;

class SearchController extends Controller
{
    protected $min;
    protected $request;

    public function __construct(Request $request, MinistryRepo $min)
    {
        $this->min = $min;
        $this->request = $request;
    }

    public function index()
    {
        $data['page_title'] = 'Search';

        return view('pages.ministry.search.index', $data);
    }

    public function process()
    {
        $req = $this->request->only(['name', 'state', 'country_code', 'min_cat_id', 'postal_code', 'founder', 'address']);

        // Exact Values
        $q1['min_cat_id'] = array_key_exists('min_cat_id', $req) ? Fam::decodeHash($req['min_cat_id']) : '';
        $q1['country_code'] = array_key_exists('country_code', $req) ? $req['country_code'] : '';

        // String Wild card Values
        $q2['name'] = array_key_exists('name', $req) ? $req['name'] : '';
        $q2['state'] = array_key_exists('state', $req) ? $req['state'] : '';
        $q2['address'] = array_key_exists('address', $req) ? $req['address'] : '';
        $q2['founder'] = array_key_exists('founder', $req) ? $req['founder'] : '';
        $q2['city'] = array_key_exists('city', $req) ? $req['city'] : '';
        $q2['postal_code'] = array_key_exists('postal_code', $req) ? $req['postal_code'] : '';

        $q1 = array_filter($q1);
        $q2 = array_filter($q2);

        if(count($q1) < 1 && count($q2) < 1){
            return back()->with('flash_danger', 'All fields cannot be empty, at Least one field is required.');
        }

        $mins = $this->min->findSearchQuery($q1, $q2)->paginate(20);
        if (count($mins) < 1) {
            return back()->with('flash_warning', 'There are no results found for your search');
        }

         $this->request->session()->put('mins', $mins);

        return redirect()->route('search');
    }
}
