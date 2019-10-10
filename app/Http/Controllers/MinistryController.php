<?php

namespace App\Http\Controllers;

use App\Http\Requests\MinistryRequest;
use App\Repositories\MinistryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyHelper\Fam;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MinistryController extends Controller
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
        $data['page_title'] = 'Find Ministries';
        $data['md'] = 'FIND A MINISTRY is a Platform for Finding Churches, Ministers, and Ministries and Helping them to Find You and Yours. Show your Ministry! Find Ministries!! Connect to Ministries. We live in a world sworn to dismantle all barriers to information, connectivity, and information (or idea) sharing.';

        $data['body_class'] = 'page-sub-page page-listing page-grid page-search-results';
        $data['mins'] = $this->min->all()->paginate(30);

        if(Auth::check()){ // Get User Bookmarks If They Exists
            $my_favs = $this->min->getMyMinBookmarks()->get();
            $data['my_fav_ids'] = $my_favs->pluck('id')->toArray();
        }

        return view('pages.ministry.index', $data);
    }

    public function show($min)
    {
        $min = $this->min->show($min);
        if(!$min){
            return redirect()->route('ministries');
        }

        if(Auth::check()){ // Get User Bookmarks If They Exists and Set Fav
            $my_favs = $this->min->getMyMinBookmarks()->get();
            $data['min_is_fav'] = $my_favs->contains('id', $min->id);
            }

        $data['body_class'] = 'page-sub-page page-property-detail';
        $data['page_title'] = Str::limit($min->name, 35);
        $data['min'] = $min;
        $data['md'] = Str::limit(strip_tags($min->description), 300);
        $data['og_image'] = $min->photo;
        $data['og_url'] = $min->url;


        return view('pages.ministry.show', $data);
    }

    public function create()
    {
        $data['body_class'] = 'page-sub-page page-submit';
        $data['page_title'] = 'Add Ministry';
        $data['md'] = 'Add A New Ministry. We provide a platform for show casing your ministry to the world. Submit a ministry for free today, so that people can find and connect with ease';

        return view('pages.ministry.add', $data);
    }

    public function edit($id)
    {
        $min = $this->min->getMyMinistries();

        /*Redirect if Min Not Found or User doesn't Own Ministry*/
        if(!Fam::validateMinistry($id, $min)) {
           return redirect()->route('my_ministries');
       }

        $data['body_class'] = 'page-sub-page page-submit';
        $data['page_title'] = 'Edit Ministry';
        $data['min'] = $this->min->find($id);
        $data['md'] = 'Manage your Ministries all in one place, login to your account, edit and update your Ministry details with the most recent information';

        return view('pages.ministry.edit', $data);
    }

    /*Update Ministry*/
    public function update(MinistryRequest $req, $id)
    {
        $min = $this->min->getMyMinistries();

        /*Redirect if Min Not Found or User doesn't Own Ministry*/
        if(!Fam::validateMinistry($id, $min)) {
            return redirect()->route('my_ministries');
        }

          $data = $req->except(['min_photo', 'name']); /* Request Form Data Except Photo */
        $count_description = str_word_count(strip_tags($data['description']));
        if($count_description < 20 || $count_description > 400){
            return back()->with('flash_danger', 'Description must be Between 20 and 300 words');
        }
        $data['hq'] = 0;
        $min = $min->whereIn('id', $id); // Get Ministry

        $verified = $min->pluck('verified')->first(); // Check Verified
        $data['hq'] = ($verified && $data['hq'] == 'on') ? 1 : 0; // Set HQ
        $this->min->find($id)->update($data);

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

// Choosing a MIn Name
    public function set_min_page($id)
    {
        $this->request->validate([
            'page_name' => 'required|alpha_num|between:4,30|unique:ministries,page'
        ]);

        $min = $this->min->find($id);

        if($min->verified){
            $data['page'] = $this->request->page_name;
            $url = route('show_ministry', $data['page']);
            $data['url'] = $url;
            $this->min->update($id, $data);

            return 'Your Ministry Page Name Has Been Successfully updated. You can Now visit '.'<a target="_blank" href="'.$url. '"><strong>'.$url.'</strong></a>';
        }

       return false;
    }

    public function thank_you()
    {
        $data['body_class'] = 'page-sub-page page-submission-success';
        $data['page_title'] = 'Thank You';

        $data['md'] = 'Thank you for submitting a Ministry on our platform. We really appreciate your effort and time. You have just made a great contribution towards helping people find their Ministries. God Bless you.';

        return view('pages.ministry.thank_you', $data);
    }

    public function store(MinistryRequest $req)
    {
        $min = $req->except('min_photo');

        $count_description = str_word_count(strip_tags($min['description']));
        if($count_description < 20 || $count_description > 400){
            return back()->with('flash_danger', 'Description must be Between 20 and 300 words');
        }

        $min['country'] = Fam::getCountryName($min['country_code']);
        $min['user_id'] = Auth::user()->id;
        $min['code'] = Fam::generateMinCode($req->name);
        $min['url'] = route('show_ministry', $min['code']);

        $m = $this->min->create($min);

        // Upload Ministry Photo
        if($m->id && $req->hasFile('min_photo')){
           $file = $req->file('min_photo');
            $image = Image::make($file)->resize(440, 330);
            $data = Fam::getFileMetaData($file);
            $data['ministry_id'] = $m->id;
            $data['title'] = 'MIN_PHOTO';
            $data['name'] = $data['title'].'.'.$data['ext'];
            $data['path'] = Fam::getPublicImagePath().$m->code;
            $data['url'] = asset($data['path'].'/'.$data['name']);

            /*Upload Image*/
            $file_path = $data['path'].'/'.$data['name'];
            file_exists($file_path) ?: mkdir($data['path'], 0757, true);

            $saved = $image->save($file_path);
            $data['size'] = Fam::getImageSize($saved->filesize());

            $this->min->newUpload($data);
            $this->min->update($m->id, ['photo' => $data['url']]);
        }
        return redirect()->route('thank_you');
    }
}
