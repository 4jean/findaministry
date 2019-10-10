<?php

namespace App\Http\Controllers;

use App\MyHelper\Fam;
use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $request;
    protected $loc;
    protected $min;

    public function __construct(Request $request, MinistryRepo $min)
    {
        $this->request = $request;
        $this->min = $min;
    }

    public function get_country_states($country_code)
    {
        $data = [];
        $states = Fam::getCountryStates($country_code);
        foreach($states as $state){
            $data[] = ['id' => $state, 'name' => $state];
        }
        return json_encode($data);
    }

    public function set_fav_min()
    {
        $min_id = Fam::decodeHash($this->request->min_id);
        $has_fav = $this->min->checkMinBookmark($min_id);
        $has_fav ? $this->min->deleteMinBookmark($min_id) : $this->min->createMinBookmark($min_id); // Create or Delete Bookmark

        return $has_fav;
    }

    public function min_names()
    {
        return $this->min->getMinNames();
    }
}
