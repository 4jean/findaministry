<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="FindAMinistry">
    <meta name="keywords" content="Find A Ministry">
    <meta name="title" content="{{ $page_title ?? config('app.name') }}">
    <meta name="description" content="{{ $md ?? $def_md }}">
    <meta property="og:title" content="{{ $page_title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $md ?? $def_md }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ $og_url ?? Request::url() }}">
    <meta property="og:image" content="{{ $og_image ?? Fam::getBannerImage() }}">
    <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.inc_top')

    <title>
        {{ $page_title ? $page_title .' | '. config('app.name') : config('app.name') }}
    </title>

</head>

<body class="{{ $body_class ?? 'page-sub-page' }}" id="page-top" data-spy="scroll" data-target=".navigation" data-offset="90">

<div class="wrapper">

    {{--<!-- /.navigation -->--}}
    @include('partials.nav')

    {{-- Alert Area--}}
    @include('partials.alerts')


@if($page_title == 'Home')

    @include('partials.slider')
    @include('partials.search_box')

    @endif

    <div id="page-content">

        <div class="container">
        @yield('bc')         {{-- Breadcrumbs--}}
        </div>

        @yield('content')
    </div>
    <!-- end Page Content -->
    <!-- Page Footer -->
    @include('partials.footer')

    <!-- end Page Footer -->
</div>


@include('partials.off_inc_bottom')
@include('partials.fonts')
</body>
</html>
