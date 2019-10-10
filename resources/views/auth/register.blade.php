@extends('layouts.front.master')

@section('content')
    <div class="container">

        <header><h1>Create an Account</h1></header>

        <div class="row">
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">

                <form action="{{ route('register') }}" role="form" id="" method="post" >
                    @csrf

                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" name="fname" value="{{ old('fname') }}" class="form-control" id="fname" required>
                    </div>

                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input name="lname" type="text" class="form-control" value="{{ old('lname') }}" id="lname" required>
                    </div>

                    <div class="form-group">
                        <label for="form-create-account-email">Email:</label>
                        <input name="email" type="email" class="form-control" value="{{ old('email') }}" id="form-create-account-email" required>
                    </div>

                    <div class="form-group">
                        <label for="form-create-account-phone">Phone:</label>
                        <input name="phone" type="text" class="form-control" value="{{ old('phone') }}" id="form-create-account-phone" required>
                    </div>

                    <div class="form-group">
                        <label for="form-create-account-password">Password:</label>
                        <input name="password" type="password" class="form-control" id="form-create-account-password" required>
                    </div>

                    <div class="form-group">
                        <label for="form-create-account-confirm-password">Confirm Password:</label>
                        <input name="password_confirmation" type="password" class="form-control" id="form-create-account-confirm-password" required>
                    </div>

                    <div class="form-group clearfix">
                        <button type="submit" class="btn pull-right btn-default" id="account-submit">Create an Account</button>
                    </div>
                </form>
                <hr>
                <div class="center">
                    <figure class="note">By clicking the “Create an Account” button you agree with our <a target="_blank" href="{{ route('terms_of_use') }}">Terms and conditions</a></figure>
                </div>
            </div>
        </div><!-- /.row -->
    </div>
@endsection
