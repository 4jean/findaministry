<?php

namespace App\Repositories;

use App\Mail\Claims\ClaimRequest;
use App\Mail\Claims\ClaimStatus;
use App\Models\Claim;
use App\Models\MinBookmark;
use App\Models\MinCat;
use App\Models\Ministry;
use App\Models\MinistryUpload;
use App\MyHelper\Fam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MinistryRepo
{

    public function all()
    {
        return Ministry::orderBy('verified', 'desc')->orderBy('created_at', 'desc');
    }

    public function getMinNames()
    {
        return Ministry::all()->pluck('name')->toJson();
    }

    public function getRandomMinistries()
    {
        return Ministry::inRandomOrder();
    }

    public function getAllCats()
    {
        return MinCat::orderBy('name', 'asc')->get();
    }


    public function find($id)
    {
        return Ministry::find($id);
    }

    public function findByField(array $data)
    {
        return Ministry::where($data)->with(['min_cat'])->orderBy('verified', 'desc')->orderBy('is_featured', 'desc')->orderBy('name');
    }

    public function findSearchQuery($q1, $q2=[])
    {
        /* $q1 have exact values while $q2 are strings for wildcard match */

        if(count($q2) && count($q1)){
            return Ministry::where(function($q) use ($q1, $q2){
                $q = $q->where($q1);
                foreach ($q2 as $k => $v) {
                    $q->orWhere($k, 'like', '%'.$v.'%');
                }
        })->orderBy('verified', 'desc')->orderBy('is_featured', 'desc')->orderBy('name');
        }

        if(count($q2)){
            return Ministry::where(function($q) use ($q2){
                foreach ($q2 as $k => $v) {
                    $q->where($k, 'like', '%'.$v.'%');
                }
            })->orderBy('verified', 'desc')->orderBy('is_featured', 'desc')->orderBy('name');
        }

        return $this->findByField($q1);
    }

    public function create($data)
    {
        return Ministry::create($data);
    }

    public function newUpload($data)
    {
        return MinistryUpload::create($data);
    }

    public function updateUpload(array $where, $data)
    {
        return MinistryUpload::where($where)->update($data);
    }

    public function update($id, $data)
    {
        return Ministry::find($id)->update($data);
    }

    public function getMyMinistries()
    {
        return Ministry::where('user_id', Auth::user()->id)->get();
    }

    public function getMyMinHQs()
    {
        return Ministry::where(['user_id' => Auth::user()->id, 'hq' => 1])->get();
    }

    public function checkVerified($ministry_id)
    {
        return Ministry::where(['verified' => 1, 'id' => $ministry_id])->exists();
    }

    public function getMinistryUpload($ministry_id, $type='')
    {
        if($type === ''){
            return MinistryUpload::where(['ministry_id' => $ministry_id])->get();
        }
        return MinistryUpload::where(['ministry_id' => $ministry_id, 'title' => $type])->get();
    }

    public function getMyMinBookmarks()
    {
        return Ministry::whereHas('bookmark', function($q){
            $q->where('user_id', Auth::user()->id);
        });
    }

    public function createMinBookmark($min_id)
    {
        $data['user_id'] = Auth::user()->id;
        $data['ministry_id'] = $min_id;
        $bk = MinBookmark::create($data);

        $this->updateMinVisits($min_id);

        return $bk;
    }

    public function deleteMinBookmark($min_id)
    {
        $data['user_id'] = Auth::user()->id;
        $data['ministry_id'] = $min_id;
        return MinBookmark::where($data)->delete();
    }

    public function checkMinBookmark($min_id)
    {
        $data['user_id'] = Auth::user()->id;
        $data['ministry_id'] = $min_id;
        return MinBookmark::where($data)->exists();
    }

    public function show($min_page_code) // Min Page or Code
    {
       $min_page = Ministry::where(function($q) use ($min_page_code) {
            return $q->where('code', $min_page_code)->orwhere('page', $min_page_code);
        })->with(['min_cat'])->get();

        if($min_page->count()){
            $min = $min_page->first();
            $this->updateMinVisits($min->id);

            return $min;
        }

        return false; // Min Not Found
    }

    public function updateMinVisits($min_id)
    {
        $data['visits'] = $this->find($min_id)->visits + 2;
        return $this->update($min_id, $data);
    }

    /************* CLAIMS *******************/

    public function newClaim($data) // Claim Ministry
    {
        $claim = Claim::create($data);
        return $this->notifyClaimRequest($claim);
    }

    public function getAllClaims()
    {
        return Claim::with(['user', 'ministry'])->orderBy('approved')->get();
    }

    public function getClaims(array $where)
    {
        return Claim::with(['user', 'ministry'])->where($where)->get();
    }

    // Find Ministry Claim by ID
    public function findClaim($id)
    {
        return Claim::find($id);
    }

    public function updateClaim($id, array $data)
    {
        return $this->findClaim($id)->update($data);
    }

    public function deleteClaim($id)
    {
        return Claim::destroy($id);
    }

    public function getClaimStatus($user_id, $min_id) // Claim Ministry
    {
        return Claim::where(['user_id' => $user_id, 'ministry_id' => $min_id])->exists();
    }

    public function notifyClaimRequest($claim)
    {
        return Mail::to(Fam::getSetting('system_email'))->send(new ClaimRequest($claim));
    }

//    Notify User of Status of Claim, Accepted/Rejected
    public function notifyClaimStatus($claim)
    {
        return Mail::to($claim->user->email)->send(new ClaimStatus($claim->id));
    }

    /*************** CLAIMS END ********************/
}
