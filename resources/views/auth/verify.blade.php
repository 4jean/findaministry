{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}

@extends('layouts.front.master')

@section('content')
    <div class="container">
        <div class="row mt-10">
            <div class="col-md-8 col-md-offset-2 ">
                <div class="panel panel-warning">
                    <div class="panel-heading">Please Verify Your Email Address</div>

                    <div class="panel-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                       <div class="text-center">
                           {{ __('Before proceeding, please check your email for a verification link.') }}
                           {{ __('If you did not receive the email') }}, <a onclick="$('form#resend-verification').submit()" href="#">{{ __('Click here to request another') }}</a>.
                           <form id="resend-verification" method="post" action="{{ route('verification.resend') }}"> @csrf </form>
                       </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

