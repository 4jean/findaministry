<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

{{--    <!-- CSRF Token -->--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    @include('admin.partials.inc_top')

</head>

<body>

{{--Top Navigation --}}
@include('admin.partials.top_nav')

<div class="page-content">

    {{-- Sidebar Navigation--}}
    @include('admin.partials.sidebar')

    <div class="content-wrapper">

        {{--Page Header--}}
        @include('admin.partials.page_header')

        {{--Error Alert Area--}}
        @if($errors->any())
            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $er)
                                <li>{{ $er }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Content Area --}}
        <div class="content">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('admin.partials.footer')

    </div>

</div>

 {{-- Javascipts --}}
@include('admin.partials.inc_bottom')

{{--Custom Page Scripts--}}
@yield('scripts')

</body>

</html>
