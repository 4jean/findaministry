@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('my_bookmarks'))

@section('content')
    .<div class="container">
        <div class="row">
            {{-- <!-- sidebar -->--}}
            <div class="col-md-3 col-sm-2">
                @include('pages.user.menu')
            </div>

            <div class="col-md-9 col-sm-10">
@include('partials.min_grid')
            </div>
        </div>

    </div>
    @endsection