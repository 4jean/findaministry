@extends('admin.layouts.master')

@section('content')
{{--    Change Ministry Name --}}
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title font-weight-bold">Change Ministry Name - {{ $min->code }}</h5>
                   {!! Fam::getPanelOptions() !!}
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('cj_set_min_page', $min->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="page_name" class="col-lg-3 col-form-label">Ministry Page Name:</label>
                            <div class="col-lg-9">
                                <input id="page_name" value="{{ $min->page }}" name="page_name" type="text" class="form-control" placeholder="Choose Page Name">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-block">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{-- Basic Info --}}
   <div class="row">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Edit Ministry - {{ $min->code }}</h5>
                {!! Fam::getPanelOptions() !!}
            </div>

            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('cj_update_min', $min->id) }}">
                    @csrf @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Basic Information</legend>

                          <div class="row">
                              {{-- Ministry Name --}}
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="name">Ministry Name: <span class="text-danger">*</span></label>
                                      <input id="name" name="name" type="text" class="form-control" placeholder="Name of My Ministry" value="{{ $min->name }}" required>
                                  </div>
                              </div>

                              {{-- Ministry Category --}}
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="min_cat_id">Select Ministry category: <span class="text-danger">*</span></label>
                                      <select name="min_cat_id" id="min_cat_id" data-placeholder="Select your state" class="form-control select-search" data-fouc>
                                          @foreach($min_cats as $min_cat)
                                              <option {{ ($min->min_cat_id == $min_cat->id) ? 'selected' : '' }} value="{{ Fam::hash($min_cat->id) }}">{{ $min_cat->name }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>

                        <div class="row">
                            {{-- Founder --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="founder" >Founder/General Overseer <span class="text-danger">*</span></label>
                                    <input type="text" id="founder" name="founder" class="form-control" value="{{ $min->founder }}"  required>
                                </div>
                            </div>

                            {{-- Keywords --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keywords" >Keywords <i class="icon-question3"  data-popup="tooltip" data-placement="right" title="Please enter Comma-separated keywords associated with your Ministry"></i></label>
                                    <input type="text" id="keywords" name="keywords" class="form-control" value="{{ $min->keywords }}"  >
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span> <i>[Only 20-300 words allowed]</i></label>
                                        <textarea class="summernote" id="description" name="description" placeholder="Description of My Ministry" required>{{ $min->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                                {{--Address--}}
                            <div class="row">
                                <div class="col-md-12">
                              <div class="form-group">
                                  <label for="address">Address / Location <span class="text-danger">*</span></label>
                                  <input required type="text" class="form-control" name="address" id="address" value="{{ $min->address }}">
                              </div>
                                </div>
                            </div>

                            <div class="row">

                                {{-- Country --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ajax_country_code">Country <span class="text-danger">*</span> </label>
                                        <select name="country_code" id="ajax_country_code" data-placeholder="Select Country"  class="select-search form-control">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $code => $country)
                                                <option {{ $min->country_code === $code ? 'selected' : '' }} value="{{ $code }}">{{ $country}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- State --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                            <label for="ajax_state">State <span class="text-danger">*</span> </label>
                                            <select name="state" id="ajax_state" data-placeholder="Select State"  class="select form-control">
                                                <option selected value="{{ $min->state }}">{{ $min->state  }}</option>
                                            </select>
                                        </div>
                                </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city" >City</label>
                                            <input type="text" id="city" name="city" class="form-control" value="{{ $min->city }}" >
                                        </div>
                                    </div>
                                </div>

                                {{-- Phone/Postal Code --}}
                                <div class="row">
                                    <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="postal_code">Postal Code</label>
                                      <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $min->postal_code }}">
                                  </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone1">Telephone <span class="text-danger">*</span></label>
                                            <input  type="text" class="form-control" id="phone1" name="phone1" value="{{ $min->phone1 }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone2">Mobile</label>
                                            <input type="text" class="form-control" id="phone2" name="phone2" value="{{ $min->phone2 }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- Website Facebook, Email --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="website">Website </label>
                                            <input id="website" type="url" name="website" class="form-control" placeholder="http://findaministry.com" value="{{ $min->website }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fb">Facebook</label>
                                            <input id="fb" type="url" name="fb" placeholder="{{ $fb_page }}" class="form-control" value="{{ $min->fb }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email </label>
                                            <input id="email" type="email" name="email" class="form-control" value="{{ $min->email }}">
                                        </div>
                                    </div>
                                </div>

                                {{--Youtube Twit Instagram--}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="yt">Youtube Channel </label>
                                            <input id="yt" type="url" name="yt" class="form-control" placeholder="Youtube Channel" value="{{ $min->yt }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tw">Twitter</label>
                                            <input id="tw" type="url" name="tw" placeholder="Twitter" class="form-control" value="{{ $min->tw }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inst">Instagram</label>
                                            <input id="inst" type="url" name="inst" placeholder="Instagram" class="form-control" value="{{ $min->inst }}">
                                        </div>
                                    </div>

                                </div>

                                {{-- Ministry Photo --}}
                                <div class="form-group">
                                      <label>Ministry Photo:</label>
                                      <input accept="image/jpeg,image/png" name="min_photo" type="file" class="form-input-styled" data-fouc>
                                      <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                </div>

                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
