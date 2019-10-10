<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MinistryRequest;
use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;
use App\MyHelper\Fam;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;


class CJMinistryController extends Controller
{
    protected $min;
    protected $request;

    public function __construct(Request $request, MinistryRepo $min)
    {
        $this->request = $request;
        $this->min = $min;
    }

    public function index()
    {
        $data['mins'] = $this->min->all();

        return view('admin.pages.ministry.index', $data);
    }

    public function edit($id)
    {
        $data['min'] = $this->min->find($id);
        return view('admin.pages.ministry.edit', $data);
    }

   /* Set Min as Verified*/
    public function verify($id)
    {
        $min_verified = $this->min->find($id)->verified;
        $data['verified'] = $min_verified ? 0 : 1;
        $this->min->update($id, $data);
        return 'success';
    }

    /*Set Min As HQ*/
    public function setHQ($id)
    {
        $min_hq = $this->min->find($id)->hq;
        $data['hq'] = $min_hq ? 0 : 1;
        $this->min->update($id, $data);
        return 'success';
    }

    /*Update Ministry*/
    public function update(MinistryRequest $req, $id)
    {
          $data = $req->except(['min_photo']); /* Request Form Data Except Photo */

        /*Check Min Description Count*/
        $count_description = str_word_count(strip_tags($data['description']));
        if($count_description < 20 || $count_description > 400){
            return back()->with('flash_danger', 'Description must be Between 20 and 300 words');
        }

        $min = $this->min->find($id);
        $min->update($data);

        if($req->hasFile('min_photo')){
            $file = $req->file('min_photo');
            $image = Image::make($file)->resize(440, 330);
            $data = Fam::getFileMetaData($file);

            /*Check If There is an Old Photo in Min Uploads*/
           $old_photo = $this->min->getMinistryUpload($id, 'MIN_PHOTO');

            if($old_photo->count()){
                $img_path = $old_photo->pluck('path')->first();
                $img_nmae = $old_photo->pluck('name')->first();
                $file_path = $img_path.'/'.$img_nmae;

                /*Upload Image*/
                file_exists($file_path) ?: mkdir($img_path, 0757, true);
                $saved = $image->save($file_path);
                $data['size'] = Fam::getImageSize($saved->filesize());

                $this->min->updateUpload(['title' => 'MIN_PHOTO', 'ministry_id' => $id], $data);
            }

            /* Create New Upload If No Old Photo */
            else {
                $code = $min->pluck('code')->first();

                $data['ministry_id'] = $id;
                $data['title'] = 'MIN_PHOTO';
                $data['name'] = $data['title'].'.'.$data['ext'];
                $data['path'] = Fam::getPublicImagePath().$code;

                $file_path = $data['path'].'/'.$data['name'];
                $data['url'] = asset($file_path);

                /*Upload Image*/
                file_exists($file_path) ?: mkdir($data['path'], 0757, true);
                $saved = $image->save($file_path);
                $data['size'] = Fam::getImageSize($saved->filesize());

//                Update DB & MINISTRY TABLE
                $this->min->newUpload($data);
                $this->min->update($id, ['photo' => $data['url']]);
            }

        }
        return back()->with('flash_success', 'Ministry Updated Successfully');
    }

    /* Delete Ministry And Associated files and Folders */
    public function delete($id)
    {
        $min = $this->min->find($id);
        $min_uploads = $this->min->getMinistryUpload($min->id)->unique();
        $min_claims = $this->min->getClaims(['ministry_id' => $min->id]);

//        Delete Claims If Exists
        if(count($min_claims)){
            Storage::delete($min_claims->pluck('url'));
        }

//        Delete Ministry Uploads & Photos
        if(count($min_uploads)){
            foreach ($min_uploads as $min_upload) {
                $min_dir = str_replace('storage/', '', $min_upload->path);
                Storage::disk($min_upload->disk)->deleteDirectory($min_dir);
            }
        }

        return $min->delete() ? 'Ministry Deleted Successfully' : 'ERROR ERROR!';

    }


    // Choosing a MIn Name
    public function set_min_page($min)
    {
        $this->request->validate([
            'page_name' => 'required|alpha_num|between:4,30|unique:ministries,page'
        ]);

        $min = $this->min->find($min);

        if($min->verified){
            $data['page'] = $this->request->page_name;
            $url = route('show_ministry', $data['page']);
            $data['url'] = $url;
            $min->update($data);

            $msg = 'Your Ministry Page Name Has Been Successfully updated. ';

            return back()->with('pop_success', $msg);
        }

       return false;
    }

}
