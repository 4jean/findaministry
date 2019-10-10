@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('categories'))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-sm-9">
                <header><h2>{{ $page_title }}</h2></header>

                <section class="block">

                    @foreach($min_cats->chunk(3) as $chunk)

                    <div class="row">
                        @foreach($chunk as $mc)

                            <div class="col-md-4">
                                <div class="panel panel-body border-top-{{ Fam::getRandomBGColor() }} text-center">
                                    <h3 style="font-weight: bold" class="no-margin">{{ $mc->name }}</h3>
                                    <hr>
                                    <a href="{{ route('categories', $mc->slug) }}" class="btn bg-brown"><i class="fa fa-bars position-left"></i> View Ministries</a>
                                </div>
                            </div>

                            @endforeach
                    </div>
                        @endforeach
                </section>
                </div>



            <div class="col-md-3 col-sm-3">
                @include('partials.sidebar')
            </div>
    </div>
    </div>
    @endsection