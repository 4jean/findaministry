@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title"><strong>Edit Ministry - {{ $min->code }}</strong></h4>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    <form role="form" id="cj_set_min_page" method="post" class="form-horizontal"  action="{{ route('cj_set_min_page', $min->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group">

                            <label class="col-md-2 control-label" for="page_name">Ministry Page Name </label>

                            <div class="col-md-7">
                                <input class="form-control" required type="text" id="page_name" value="{{ $min->page }}" name="page_name">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-danger btn-block">Submit Ministry Page Name</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    <form role="form" method="post" class="form" enctype="multipart/form-data" action="{{ route('cj_update_min', $min->id) }}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row">
                            <div class="block">
                                <div class="col-md-12">
                                    <section id="submit-form">

                                        <section id="basic-information">
                                            <header><h2>Basic Information</h2></header>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="submit-title">Name <span class="text-danger">*</span></label>
                                                        <input name="name" type="text" class="form-control" id="submit-title" placeholder="Name of My Ministry" value="{{ $min->name }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="min_cat_id">Category <span class="text-danger">*</span> </label>

                                                        <select class="select2" required name="min_cat_id"  id="min_cat_id" title="Select Category"  data-live-search="true">
                                                            @foreach($min_cats as $min_cat)
                                                                <option {{ ($min->min_cat_id == $min_cat->id) ? 'selected' : '' }} value="{{ Fam::hash($min_cat->id) }}">{{ $min_cat->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--Founder--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="founder" >Founder/General Overseer <span class="text-danger">*</span></label>
                                                        <input type="text" id="founder" name="founder" class="form-control" value="{{ $min->founder }}"  required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="keywords" >Keywords <i class="fa fa-question-circle tool-tip"  data-toggle="tooltip" data-placement="right" title="Please enter Comma-separated keywords associated with your Ministry"></i></label>
                                                        <input type="text" id="keywords" name="keywords" class="form-control" value="{{ $min->keywords }}"  >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description <span class="text-danger">*</span> <i>[Only 20-300 words allowed]</i></label>
                                                        <textarea class="summernote form-control" id="description" rows="8" name="description" placeholder="Description of My Ministry" required>{{ $min->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <hr>
                                    </section>
                                </div>
                                <hr>


                            </div>
                        </div>

                        {{--Contact Information--}}

                        <div class="row">
                            <div class="block">
                                <div class="col-md-12">

                                    <section id="contact-information">
                                        <header><h2>Contact Information</h2></header>

                                        <br>

                                        {{--Address--}}

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="address">Address / Location <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control" name="address" id="address" value="{{ $min->address }}">
                                                <br>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="country_id">Country <span class="text-danger">*</span> </label>
                                                    <select id="country_id" disabled class="form-control select2">
                                                        <option value="Nigeria">Nigeria</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ajax_state_id">State <span class="text-danger">*</span> </label>

                                                    <select class="select2" disabled name="state_id"  id="" title="Select State" >
                                                        <option selected value="">{{ $min->state }}</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ajax_lga_id">LGA <span class="text-danger">*</span> </label>

                                                    <select class="select2" disabled name="lga_id"  id="" title="Select LGA" >
                                                        <option selected value="">{{ $min }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        {{--Phone/Postal Code--}}

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="postal_code">Postal Code</label>
                                                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $min->postal_code }}">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="phone1">Telephone <span class="text-danger">*</span></label>
                                                <input  type="text" class="form-control" id="phone1" name="phone1" value="{{ $min->phone1 }}">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="phone2">Mobile</label>
                                                <input type="text" class="form-control" id="phone2" name="phone2" value="{{ $min->phone2 }}">
                                            </div>

                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="website">Website </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                        <input id="website" type="url" name="website" class="form-control" placeholder="http://findaministry.com" value="{{ $min->website }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fb">Facebook</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                                        <input id="fb" type="url" name="fb" placeholder="{{ $fb_page }}" class="form-control" value="{{ $min->fb }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Email </label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon">@</span>
                                                        <input id="email" type="email" name="email" class="form-control" value="{{ $min->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{--Youtube Twit Instagram--}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="yt">Youtube Channel </label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span>
                                                        <input id="yt" type="url" name="yt" class="form-control" placeholder="Youtube Channel" value="{{ $min->yt }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="tw">Twitter</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                                        <input id="tw" type="url" name="tw" placeholder="Twitter" class="form-control" value="{{ $min->tw }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="inst">Instagram</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                                        <input id="inst" type="url" name="inst" placeholder="Instagram" class="form-control" value="{{ $min->inst }}">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </section>

                                    <section class="block" >
                                        <header><h2>Change Photo</h2></header>
                                        <div class="center">

                                            <div class="form-group">
                                                <input name="min_photo" id="file-upload" type="file" class="file" data-show-upload="false" data-show-caption="false" data-show-remove="false"  accept="image/jpeg,image/png" data-browse-class="btn btn-danger" data-browse-label="Change Ministry Photo">
                                            </div>
                                        </div>
                                    </section>

                                </div>


                            </div>
                        </div>

                        {{--Submit--}}
                        <div class="row">
                            <div class="block">
                                <div class="col-md-12">
                                    <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save Changes</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
