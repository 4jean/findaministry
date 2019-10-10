@extends('admin.layouts.master')

@section('content')

{{--    Quick stats boxes--}}
    <div class="row">

        {{--Total Ministries--}}
        <div class="col-lg-6">
            <div class="card bg-teal-400">
                <div class="card-body">
                    <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0">{{ $rcms->get()->count() }}</h3>
                    </div>
                    <div>Total Ministries</div>
                </div>
            </div>
        </div>

        {{--Verified Ministries--}}
        <div class="col-lg-6">
            <div class="card bg-pink-400">
                <div class="card-body">
                    <div class="d-flex">
                        <h3 class="font-weight-semibold mb-0">{{ $rcms->get()->where('verified' , 1)->count() }}</h3>
                    </div>
                    <div>Verified Ministries</div>
                </div>
            </div>
        </div>

    </div>

    @endsection
