@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('ministries'))

@section('content')
    <div class="container">
        <div class="row">
            <!-- Results -->
            <div class="col-md-9 col-sm-9">
                @include('partials.min_grid')
            </div>{{--.col-md-9 --}}
            {{--<!-- end Results -->--}}

            {{--sidebar--}}
            <div class="col-md-3 col-sm-3">
@include('partials.sidebar')
            </div>

        </div> {{--Row End--}}
    </div>
    @endsection