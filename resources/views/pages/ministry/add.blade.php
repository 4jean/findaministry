@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('add_ministry'))
@section('content')
    <div class="container">
        <header><h1>Add Your Ministry</h1></header>

        <div class="alert alert-info text-center">Before you Add A Ministry, please use <a target="_blank" href="{{ route('search') }}"><strong>This Search Module</strong> </a> to check if the Ministry has been listed already. If It has been listed, please proceed to
            <a target="_blank" href="{{ route('guides.claim_ministry') }}"><strong>Claim The Ministry</strong></a></div>

        <form role="form" id="form-submit" method="post" class="form-submit" enctype="multipart/form-data" action="{{ route('store_ministry') }}">

            @csrf

            <div class="row">
                <div class="block">
                    <div class="col-md-9 col-sm-9">
                        <section id="submit-form">
                            <section id="basic-information">
                                <header><h2>Basic Information</h2></header>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="submit-title">Name <span class="text-danger">*</span> <i class="fa fa-question-circle tool-tip"  data-toggle="tooltip" data-placement="right" title="Ministry Names cannot be changed after submission"></i></label>
                                            <input type="text" class="form-control" id="submit-title" placeholder="Name of My Ministry" name="name" value="{{ old('name') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="min_cat_id">Category <span class="text-danger">*</span> <i class="fa fa-question-circle tool-tip"  data-toggle="tooltip" data-placement="right" title="Please Choose a Category which your Ministry Belongs To"></i></label>

                                            <select required name="min_cat_id"  id="min_cat_id" title="Select Category"  data-live-search="true">
                                                <option value="">Select Category</option>
                                                @foreach($min_cats as $min_cat)
                                                    <option {{ old('min_cat_id') === Fam::hash($min_cat->id) ? 'selected' : '' }} value="{{ Fam::hash($min_cat->id) }}">{{ $min_cat->name }}</option>
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
                                            <input type="text" id="founder" name="founder" class="form-control" value="{{ old('founder') }}"  >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="keywords" >Keywords <i class="fa fa-question-circle tool-tip"  data-toggle="tooltip" data-placement="right" title="Please enter Comma-separated keywords associated with your Ministry"></i></label>
                                            <input type="text" id="keywords" name="keywords" class="form-control" value="{{ old('keywords') }}"  >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description <span class="text-danger">*</span> <i>[Only 20-300 words allowed]</i></label>

                                            <textarea class="form-control summernote" id="description" rows="8" name="description" placeholder="Description of My Ministry" required>{{ old('description') }}</textarea>


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
                                <p>Enter Basic information about your Ministry. Be descriptive. Please note that Ministry Names CANNOT be changed after submission
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

                            {{--Address--}}

                            <div class="row">
                            <div class="col-md-12">
                                <label for="address">Address / Location <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                                <br>
                            </div>
                            </div>

                            {{--Country, State and City--}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ajax_country_code">Country <span class="text-danger">*</span></label>

                                        <select required="required"  name="country_code"  id="ajax_country_code" title="Select Country"  data-live-search="false">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $code => $country)
                                                <option {{ old('country') ? 'selected' : '' }} value="{{ $code }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ajax_state">State <span class="text-danger">*</span> </label>

                                        <select name="state"  id="ajax_state" title="Select State"  data-live-search="false">
                                            @if(old('state'))
                                                <option selected value="{{ old('state') }}">Select State</option>

                                            @else
                                            <option value="">Select State</option>
                                                @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="city">City </label>
                                       <input name="city" id="city" type="text" placeholder="City" class="form-control" />
                                   </div>
                               </div>
                            </div>

                            <br>
                            {{--Phone/Postal Code--}}

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="phone1">Telephone </label>
                                    <input type="text" class="form-control" id="phone1" name="phone1" value="{{ old('phone1') }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="phone2">Mobile</label>
                                    <input type="text" class="form-control" id="phone2" name="phone2" value="{{ old('phone2') }}">
                                </div>

                            </div>
                            <br>
{{--Web Email Facebook--}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="website">Website </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                        <input id="website" type="url" name="website" class="form-control" placeholder="http://findaministry.com" value="{{ old('website') }}">
                                            </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fb">Facebook</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                        <input id="fb" type="url" name="fb" placeholder="http://facebook.com/findaministry" class="form-control" value="{{ old('fb') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email </label>

                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--Youtube Twitter Instagram--}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="yt">Youtube Channel </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span>
                                            <input id="yt" type="url" name="yt" class="form-control" placeholder="Youtube Channel" value="{{ old('yt') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tw">Twitter</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                            <input id="tw" type="url" name="tw" placeholder="Twitter" class="form-control" value="{{ old('tw') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inst">Instagram</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                            <input id="inst" type="url" name="inst" placeholder="Instagram" class="form-control" value="{{ old('inst') }}">
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </section>

                        <section class="block" id="gallery">
                            <header><h2>Upload Photo</h2></header>
                            <div class="center">
                                <div class="form-group">
                                    <input name="min_photo" id="file-upload" type="file" class="file" data-show-upload="false" data-show-caption="false" data-show-remove="false" value="{{ old('min_photo') }}"  accept="image/jpeg,image/png" data-browse-class="btn btn-danger" data-browse-label="Browse Ministry Photo">
                                    <figure class="note"><strong>Hint:</strong> Max Image Size 2MB</figure>
                                </div>
                            </div>
                        </section>
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
                                <button type="submit" class="btn btn-default large">Add New Ministry <i class="fa fa-arrow-right"></i></button>
                            </div><!-- /.form-group -->
                            <figure class="note block">By clicking the “Add Ministry” or “Submit” button you agree with our <a href="{{ route('terms_of_use') }}">Terms and conditions</a></figure>
                        </div>
                    </div>

                </div>
            </div>

        </form><!-- /#form-submit -->
    </div>
    @endsection
