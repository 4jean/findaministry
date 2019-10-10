@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('guides'))

@section('content')
    <div class="container">
        <div class="row">
            <!-- Content -->
            <div class="col-md-9 col-sm-9">
                <section id="content">
                    <header><h1>{{ config('app.name') }} Guides</h1></header>

                    @foreach($guides->paginate(10) as $guide)
                    <article class="blog-post">

                        <header><a href="{{ route($guide->name) }}"><h2>{{ $guide->title }}</h2></a></header>

                        <p>{{ $guide->content }}</p>
                        <a href="{{ route($guide->name) }}" class="link-arrow">Read More</a>
                    </article>
                    @endforeach


                    <div class="center">{{ $guides->paginate()->links() }}</div><!-- /.center-->
                </section>
            </div>

       {{--     <!-- sidebar -->--}}
            <div class="col-md-3 col-sm-3">
              @include('partials.sidebar')
            </div>

        </div>
    </div>
    @endsection