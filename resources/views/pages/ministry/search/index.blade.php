@extends('layouts.front.master')

@section('bs', Breadcrumbs::render('search'))

@section('content')
    <div class="container">

        <header><h1>{{ config('app.name') }}</h1></header>

     <div class="row">
         <div class="col-md-9">
             <section>

                 <div class="panel-group"  id="accordion" role="tablist" aria-multiselectable="true">
                     <div class="panel panel-default" style="overflow: visible">

                         <div class="panel-heading" role="tab" id="headingOne">
                             <h4 class="panel-title">
                                 <a class="{{ session('mins') ? 'collapsed' : '' }}" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     Use This Search Form To Find A Ministry
                                 </a>
                             </h4>
                         </div>

                         <div id="collapseOne" class="panel-collapse {{ session('mins') ? 'collapse' : 'collapse in' }}" role="tabpanel" aria-labelledby="headingOne">
                             <div class="panel-body">

                                 <div id="search-panel">
                                     <div class="alert alert-info text-center">Please use the search form to Find Ministries, at Least One Field is Required</div>

                                     <form id="search_form" method="post" action="{{ route('search.post') }}">
                                         @csrf

                                         {{--Min Name & Category--}}
                                         <div class="row">
                                             <div class="col-md-8">
                                                 <div class="form-group">
                                                     <label for="min_name">Name </label>
                                                     <input type="text" class="form-control" id="min_name" autocomplete="off" value="{{ old('name') }}" placeholder="Name of Ministry" name="name" >
                                                 </div>
                                             </div>

                                             <div class="col-md-4">
                                                 <div class="form-group">
                                                     <label for="min_cat_id">Category</label>

                                                     <select  name="min_cat_id"  id="min_cat_id" title="Select Category"  data-live-search="true">
                                                         <option value="">Select Category</option>
                                                         @foreach($min_cats as $min_cat)
                                                             <option {{ old('min_cat_id') ? 'selected' : '' }} value="{{ Fam::hash($min_cat->id) }}">{{ $min_cat->name }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>
                                             </div>
                                         </div>

                                         {{--Founder and Address--}}
                                         <div class="row">
                                             <div class="col-md-4">
                                                 <div class="form-group">
                                                     <label for="founder" >Founder/General Overseer</label>
                                                     <input type="text" id="founder" name="founder" class="form-control" value="{{ old('founder') }}"  >
                                                 </div>
                                             </div>

                                             <div class="col-md-8">
                                                 <div class="form-group">
                                                     <label for="address" >Address</label>
                                                     <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}"  >
                                                 </div>
                                             </div>
                                         </div>

                                         {{--COUNTRY, STATE AND POSTAL CODE--}}

                                         <div class="row">
                                             <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label for="ajax_country">Country </label>

                                                     <select  name="country_code"  id="ajax_country_code" title="Select Country"  data-live-search="true">
                                                         <option value="">Select Country</option>
                                                         @foreach($countries as $code => $country)
                                                             <option {{ old('country_code') ? 'selected' : '' }} value="{{ $code }}">{{ $country }}</option>
                                                         @endforeach
                                                     </select>
                                                 </div>

                                             </div>

                                             <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label for="ajax_state">State </label>

                                                     <select  name="state"  id="ajax_state" title="Select State"  data-live-search="true">
                                                         <option value="">Select State</option>
                                                     </select>
                                                 </div>
                                             </div>

                                             <div class="col-md-3">
                                                 <label for="city">City</label>
                                                 <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                                             </div>

                                             <div class="col-md-3">
                                                 <label for="postal_code">Postal Code</label>
                                                 <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                                             </div>
                                         </div>

                                         <br>
                                         <hr>

                                         <div class="row">
                                             <div class="col-md-12">
                                                 <div class="form-group">
                                                     <div class="text-center">
                                                         <button type="submit" id="find_ministry" class="btn btn-danger btn-lg"><i class="fa fa-search"></i> Find Ministry</button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>

                                     </form>

                                 </div>

                             </div>
                         </div>
                     </div>

                 </div>
             </section>


             <section>
<div class="row">
    <div class="col-md-12">
        <div id="search_results"></div>
        @if(session('mins'))
        @include('pages.ministry.search.masonry_results')
        @endif
    </div>
</div>
             </section>
         </div>

         <div class="col-md-3">
             @include('partials.sidebar')
         </div>
     </div>
    </div>
    @endsection
