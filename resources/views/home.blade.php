@extends('layouts.front.master')

@section('content')
    <section id="banner">
        <div class="block has-dark-background background-color-default-darker center text-banner">
            <div class="container">
                <h1 class="no-bottom-margin no-border">Find &amp; Connect with Ministries, Show your Ministry &amp; help others find you <a href="{{ route('add_ministry') }}" class="text-underline">Get Started</a>!</h1>
            </div>
        </div>
    </section>

    {{--FAM FEATURES & SERVICES--}}
    <section id="our-services" class="block">
        @include('partials.ministry.features')
    </section>

    <section id="new-properties" class="block">
        <div class="container">
            <header class="section-title">
                <h2>Featured Ministries </h2>
                <a href="{{ route('ministries') }}" class="link-arrow">All Ministries</a>
            </header>
            @include('partials.ministry.recent')

        </div>
    </section>

    {{--  @include('partials.ministry.advert')--}}

    {{-- Random Ministries --}}
    <section id="partners2" class="block">
        <div class="container">
            <header class="section-title"><h2>Ministries</h2>
                <a href="{{ route('ministries') }}" class="link-arrow">All Ministries</a>
            </header>

            @include('partials.ministry.random')
        </div>
    </section>

    {{--Ministry Categories--}}
    <section id="partners" class="block">
        <div class="container">
            <header class="section-title"><h2>Ministry Categories</h2>
                <a href="{{ route('categories') }}" class="link-arrow">All Categories</a>
            </header>

            @include('partials.ministry.cat_slider')
        </div>
    </section>
@endsection
