@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('my_profile') )

@section('content')
    <div class="container">
        <div class="row">
         {{--   <!-- sidebar -->--}}
            <div class="col-md-3 col-sm-2">
        @include('pages.user.menu')
            </div>

            <div class="col-md-9 col-sm-10">
                <section id="profile">
                    <header><h1>Profile</h1></header>
                    <div class="account-profile">
                        <div class="row">

                            <div class="col-md-9 col-sm-9">
                                <form role="form" id="form-account-profile" method="post" action="{{ route('update_profile') }}" >
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <section id="contact">
                                        <h3>Contact</h3>

                                        <dl class="contact-fields">
                                            <dt><label for="form-account-name">Your Name:</label></dt>
                                            <dd>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="form-account-name" disabled name="form-account-name"  value="{{ Auth::user()->fname. ' '.Auth::user()->lname  }}">
                                                </div>
                                            </dd>
                                            <dt><label for="form-account-phone">Phone:</label></dt>
                                            <dd><div class="form-group">
                                                    <input type="text" class="form-control" id="form-account-phone" name="phone" value="{{ Auth::user()->phone }}">
                                                </div>
                                            </dd>
                                            <dt><label for="form-account-email">Email:</label></dt>
                                            <dd><div class="form-group">
                                                    <input type="text" class="form-control" id="form-account-email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </dd>
                                 </dl>
                                        <div class="center">
                                            <button type="submit" class="btn btn-info" >Update Changes</button>
                                        </div>
                                    </section>

                                </form>
                                <br>

                                <section id="change-password">
                                    <header><h2>Change Your Password</h2></header>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <form role="form" id="form-account-password" method="post" action="{{ route('update_password') }}" >
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <div class="form-group">
                                                    <label for="form-account-password-current">Current Password</label>
                                                    <input required type="password" class="form-control" id="form-account-password-current" name="current_password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="form-account-password-new">New Password</label>
                                                    <input required type="password" class="form-control" id="form-account-password-new" name="password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="form-account-password-confirm-new">Confirm New Password</label>
                                                    <input required type="password" class="form-control" id="form-account-password-confirm-new" name="password_confirmation">
                                                </div>
                                                <div class="center form-group clearfix">
                                                    <button type="submit" class="btn btn-default" >Change Password</button>
                                                    <br>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
    @endsection