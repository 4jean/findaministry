<?php

namespace App\Http\Controllers;

use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyHelper\Fam;
use Illuminate\Support\Str;


class ClaimController extends Controller
{
    protected $min;
    protected $request;

    public function __construct(Request $request, MinistryRepo $min)
    {
        $this->request = $request;
        $this->min = $min;
    }

//    Show Claim Request Form & Guide to Submit Claim
    public function index($id)
    {
        $data['page_title'] = 'Claim Ministry';
        $min = $this->min->find($id);
        if($min->count()){
            $data['min'] = $min;
            $data['claim_sent'] = $this->min->getClaimStatus(Auth::user()->id, $min->id);

            $data['md'] = Str::limit(strip_tags($min->description), 300);
            $data['og_image'] = $min->photo;
            $data['og_url'] = $min->url;

            return view('pages.ministry.claim', $data);
        }

        return redirect()->route('ministries');
    }

//   Submit Claim for Admin Approval
    public function verify_ministry($id)
    {
        $this->request->validate([
            'claim_file' => 'required|mimes:pdf,jpg,jpeg,png|max:20000'
        ]);

        $min = $this->min->find($id);
        if($this->request->hasFile('claim_file') && $min->id){
            $file = $this->request->file('claim_file');
            $ext  = $file->extension();
            $data['user_id'] = Auth::user()->id;
            $data['ministry_id'] = $id;
            $data['url'] = $file->storeAs(Fam::getClaimsUploadPath(), 'CLAIM_'.$min->code.'.'.$ext, 'local');

            $this->min->newClaim($data);

            return back()->with('flash_success', 'Your Request has been sent and will be processed as soon as possible');

        }
        return back()->with('flash_danger', 'An Error Has Occured');
    }
}
