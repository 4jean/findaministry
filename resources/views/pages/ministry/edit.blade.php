@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('edit_ministry', $min))

@section('content')
    <div class="container">

        <header><h1>Edit Your Ministry</h1></header>


        {{--Page Name Section--}}
        @if(!$min->page)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Choose A Page Name for Your Ministry</h3>
                    </div>
                    <div class="panel-body">

<div id="page_alert" class="alert alert-info text-center">Choose A unique Name to Identify your Ministry. Your Ministry url will be <strong>{{ url('/') }}/page_name</strong>. You can share The Link with others. <strong><i>NOTE:</i></strong> Only
    <a target="_blank" href="{{ route('claim_ministry', Fam::hash($min->id)) }}"><strong>VERIFIED</strong></a> Ministries can choose a Name. follow
    <a target="_blank" href="{{ route('set_page_name') }}"><strong>This Guide</strong></a> before choosing a Name</div>

                        <form role="form" id="set_min_page" method="post" class="form-submit {{ $min->verified ?: 'disabled' }}"  action="{{ route('set_min_page', Fam::hash($min->id)) }}">
                            @csrf

<div class="form-group">

    <label class="col-md-3" for="page_name">Enter Ministry Page Name <i class="fa fa-question-circle tool-tip"  data-toggle="tooltip" data-placement="top" title="The Page Name Cannot Be Changed after Submission"></i></label>

    <div class="col-md-6">
        <input class="form-control" required min="5" maxlength="30" type="text" id="page_name" placeholder="Enter Page Name" name="page_name">
    </div>

  <div class="col-md-3">
      <button type="submit" class="btn btn-danger btn-block">Submit Ministry Page Name</button>
  </div>
</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--Page Name End--}}
        <hr class="thick">
        @endif

        <form role="form" id="form-submit" method="post" class="form-submit" enctype="multipart/form-data" action="{{ route('update_ministry', Fam::hash($min->id)) }}">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
                <div class="block">
                    <div class="col-md-9 col-sm-9">
                        <section id="submit-form">

                            <section id="basic-information">
                                <header><h2>Basic Information</h2></header>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="submit-title">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="submit-title" placeholder="Name of My Ministry" disabled value="{{ $min->name }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="min_cat_id">Category <span class="text-danger">*</span> <i class="fa fa-question-circle tool-tip"  data-toggle="tooltip" data-placement="right" title="Please Choose a Category which your Ministry Belongs To"></i></label>

                                            <select required name="min_cat_id"  id="min_cat_id" title="Select Category"  data-live-search="true">
                                                @foreach($min_cats as $min_cat)
                                                    <option {{ ($min->min_cat_id === $min_cat->id) ? 'selected' : '' }} value="{{ Fam::hash($min_cat->id) }}">{{ $min_cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{--Founder--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="founder" >Founder/General Overseer </label>
                                            <input type="text" id="founder" name="founder" class="form-control" value="{{ $min->founder }}"  >
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

                    <div class="col-md-3 col-sm-3">
                        <aside class="submit-step">
                            <figure class="step-number">1</figure>
                            <div class="description">
                                <h4>Basic Information</h4>
                                <p>Enter Basic information about your Ministry. Be descriptive.
                                </p>
                            </div>
                        </aside>
                    </div>

                </div>
            </div>

            {{--Contact Information--}}

            <div class="row">
                <div class="block">
                    <div class="col-md-9 col-sm-9">

                        <section id="contact-information">
                            <header><h2>Contact Information</h2></header>

                            {{--HQ INFO--}}
                            <div class="checkbox switch" id="hq-switch">
                                <label>
                                    <strong>This is The Headquarters</strong> <input {{ $min->hq ? 'checked' : '' }}  name="hq" type="checkbox">
                                </label>
                            </div>

                            <section id="hq-info" class="hidden">
                                {{--If you are not verified--}}
@if(!$min->verified)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">You need to verify that This Ministry Belongs to you, before you can mark it as HeadQuarters,
                                            <a  href="{{ route('claim_ministry', Fam::hash($min->id)) }}"><strong>Click Here to Verify This Ministry</strong></a> </div>
                                    </div>
                                </div>
                                @endif
                            </section>
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
                                        <label for="country_code">Country <span class="text-danger">*</span> <i class="fa fa-question-circle tool-tip"  data-toggle="tooltip" data-placement="right" title="Select Country"></i></label>
                                        <select id="country_code" disabled class="form-control">
                                            <option value="{{ $min->country_code }}">{{ $min->country }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ajax_state_id">State <span class="text-danger">*</span> </label>

                                        <select disabled  id="ajax_state_id" title="Select State" >
                                            <option selected value="">{{ $min->state }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">City</label>

                                        <input id="city" type="text" name="city" value="{{ $min->city }}" class="form-control">
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
                                    <label for="phone1">Telephone </label>
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
                                    <figure class="note"><strong>Hint:</strong> Max Image Size 2MB</figure>
                                </div>
                            </div>
                        </section>

                        <section class="block" id="gallery">
                            <header><h2>Gallery</h2></header>
                            <div class="center">
                                <div class="form-group">
                                    <input disabled id="file-upload" type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-default" data-browse-label="Browse Images">
                                    <figure class="note"><strong>Hint:</strong> You can upload all images at once!</figure>
                                </div>
                            </div>
                        </section>

                {{--        <section class="block" >
                            <header><h2>News & Events</h2></header>
                            <hr>
                        </section>--}}
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <aside class="submit-step">
                            <figure class="step-number">2</figure>
                            <div class="description">
                                <h4>Contact Information</h4>
                                <p>Enter Contact information about your Ministry. .
                                </p>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>

            {{--Submit--}}
            <div class="row">
                <div class="block">
                    <div class="col-md-9 col-sm-9">
                        <div class="center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default large"><i class="fa fa-save"></i> Save Changes</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form><!-- /#form-submit -->
    </div>
@endsection
