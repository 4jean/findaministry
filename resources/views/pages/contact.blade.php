@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('contact'))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-sm-9">
                <header><h2>{{ $page_title }}</h2></header>

                <section>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="panel panel-body border-top-primary text-center">
                                <i class="fa fa-map-marker" style=" font-size:40px;">  </i> <br>
                                <span style="font-weight: bold; font-size:40px;"> {{ config('app.name') }}</span> <br>
                                <span style=" font-size:30px;"> P. O. Box 59, Karu, 900008, Abuja. Nigeria</span> <br>

                                <hr>
                                <span style="font-size:30px;"><i class="fa fa-phone"></i> +234 706 814 9559 </span> <br>
                                <span style="font-size:30px;"><a href="{{ $fb_page }}" target="_blank"><i class="fa fa-facebook"></i>acebook Page</a></span> <br>

                            </div>

                        </div>
                    </div>
                </section>

                <hr class="thick">

                <section id="form">
                    <header><h3>Send Us a Message</h3></header>

                    <form role="form" action="{{ route('contact_form') }}" id="form-contact" method="post"  class="clearfix">

                        @csrf
                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form-contact-name">Your Name<em>*</em></label>
                                    <input value="{{ old('name') }}" type="text" class="form-control" id="form-contact-name" name="name" required>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form-contact-email">Your Email<em>*</em></label>
                                    <input value="{{ old('email') }}" type="email" class="form-control" id="form-contact-email" name="email" required>
                                </div>
                            </div>
                        </div>

                        {{-- Message --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form-contact-message">Your Message<em>*</em></label>
                                    <textarea class="form-control" id="form-contact-message" rows="8" name="message" required>{{ old('message') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Captcha --}}
                        <div class="row mt-5 mb-5">
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! captcha_img() !!}
                                </div>
                            </div>

                            <div class="col-md-10">
                                <input autocomplete="off" placeholder="Enter The Captcha Code" type="text" class="form-control" id="captcha" name="captcha" required>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <button type="submit" class="btn pull-right btn-default" id="form-contact-submit">Send Message</button>
                        </div>

                        <div id="form-status"></div>
                    </form>
                </section>

            </div>

            <div class="col-md-3 col-sm-3">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
@endsection
