@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('guides.verify_ministry'))

@section('content') >
    <style>
        ul.verify-steps li{
            padding-bottom: 10px;;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <header><h2>{{ $page_title }}</h2></header>
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>GUIDE TO CLAIMING OR VERIFYING A MINISTRY</strong></h3>
                    </div>

                    <div class="panel-body" style="color:#000">
                        <section>
                            <p> We want people to find your Ministry easily, because Verified/Claimed Ministries are displayed at the top of search results. Also, if You have a Headquarter Ministry, you can add your branch ministries so that people can easily find all your ministries</p>

                            <p> You can Claim A Ministry by visiting the Ministry Page. If The Ministry is yet to be claimed or verified. A Button will be displayed tagged <i><strong>Verify or Claim This Ministry</strong></i>, otherwise if the Ministry has been Claimed by someone else and you know the Ministry belongs to you, please Contact us and the issue will be resolved.</p>

                            <p>You can Claim a Ministry after you have logged in to your account, then proceed with the following steps:</p>

                            <ul class="verify-steps">
                                <li>Upload a letter Headed document requesting Approval of Your Ministry <strong><i>Your Documents will be kept Confidential</i></strong></li>

                                <li>Send a Message from your official Facebook Page to our <a href="{{ $fb_page }}">Facebook Page</a> stating the Ministry name and code you wish to claim. You will receive a reply as soon as possible</li>
                                <li>Share Your Ministry Page on your Facebook, Twitter or Instagram page. This requires that you have a minimum of 100 followers and the page name and description must correspond. Then Send a message to our <a href="{{ $fb_page }}">Facebook Page</a> so that we can verify as soon as possible </li>

                                <li>If you have any enquiries. Please send us a message on Facebook or use our <a target="_blank" href="{{ route('contact') }}">Contact Form</a> or call us on 07068149559, 08027444825</li>

                            </ul>
                        </section>

                    </div>
                </div>


            </div>

            {{--SIDEBAR--}}
            <div class="col-md-3">
                @include('partials.sidebar')
            </div>
        </div>
    </div>

    @endsection