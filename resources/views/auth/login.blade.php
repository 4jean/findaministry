@extends('layouts.front.master')

@section('content')
    <div class="container">
        <header><h1>Sign In</h1></header>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">


                <form role="form" action="{{ route('login') }}" id="form-create-account" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="form-create-account-email">Email:</label>
                        <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="form-create-account-email" required>
                    </div>

                    <div class="form-group">
                        <label for="form-create-account-password">Password:</label>
                        <input name="password" type="password" class="form-control" id="form-create-account-password" required>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input  type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>

                    <div class="form-group clearfix">
                        <button type="submit" class="btn pull-right btn-default" id="account-submit">Login to My Account</button>
                    </div>
                </form>
                <hr>

                <div class="center"><a href="{{ route('password.request') }}">I don't remember my password</a></div>
                <div class="center"><a href="{{ route('register') }}">Create New Account</a></div>
            </div>
        </div><!-- /.row -->
    </div>
@endsection
