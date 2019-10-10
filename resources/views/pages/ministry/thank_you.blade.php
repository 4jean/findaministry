@extends('layouts.front.master')
@section('bc', Breadcrumbs::render('thank_you'))
@section('content')
    <div class="container">
        <section class="center submission-message">
            <header>Thank you for your submission!</header>
            <h3>Your Ministry has Been Created Successfully</h3>
            <a href="{{ route('my_ministries') }}" class="btn btn-lg btn-success"><i class="fa fa-home"></i> Manage My Ministries</a>
        </section>
    </div>
    @endsection