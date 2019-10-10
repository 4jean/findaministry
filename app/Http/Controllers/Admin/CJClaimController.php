<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class CJClaimController extends Controller
{
    protected $min;
    protected $request;

    public function __construct(Request $request, MinistryRepo $min)
    {
        $this->request = $request;
        $this->min = $min;
    }

//    Manage Ministry Claims
    public function index($ministry_id = null)
    {
        $data['claims'] = $cms = $this->min->getAllClaims();
        $data['selected'] = false;

        if($ministry_id){
            $data['selected'] = true;
            $data['min'] = $this->min->find($ministry_id);
        }

         return view('admin.pages.ministry.claim', $data);
    }

    public function download_file($claim_id)
    {
        $claim = $this->min->findClaim($claim_id);
        return response()->download(Storage::path($claim->url));
    }

    public function view_file($claim_id)
    {
        $claim = $this->min->findClaim($claim_id);
        return response()->file(Storage::path($claim->url));
    }

//    Approve or Reject if already approved (Toggle)
    public function approve($claim_id)
    {
        $claim = $this->min->findClaim($claim_id);

        $data['user_id'] = $claim->user_id;
        $data['verified'] = $claim->approved ? 0 : 1;

        $this->min->update($claim->ministry_id, $data);
        $this->min->updateClaim($claim_id, ['approved' => $claim->approved ? 0 : 1]);

        // Send emails of Approval/Rejection to users
        $this->min->notifyClaimStatus($claim);

        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function delete($id)
    {
        $claim = $this->min->findClaim($id);

        if($claim->approved){
            $this->min->update($claim->ministry_id, ['verified' => 0]);
            $claim->update(['approved' => 0]);
        }

        $this->min->notifyClaimStatus($claim); // Claim Rejected

        Storage::delete($claim->url); // Delete Claim File
        $this->min->deleteClaim($id);
        return __('msg.del_ok');
    }

}
