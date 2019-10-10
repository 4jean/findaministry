@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('claim_ministry', $min))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-3">
                <header><h2>{{ $page_title.' - '.$min->name }} </h2></header>

                {{--If Ministry Has Been Claimed--}}
                @if($min->verified)
                <div class="row">
    <div class="col-md-12">
        <div class="alert alert-info text-center">
            This Ministry Has Been CLAIMED
        </div>
    </div>
                </div>

                @elseif($claim_sent) {{--If User Have Requested Claim--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        Your Claim Request Has Been Submitted and is being processed.
                    </div>
                </div>
            </div>


                     {{--If Ministry Yet to Be Claimed--}}
                     @else
                     <div class="row">
                         <div class="col-md-12">

                             <div class="panel panel-default">
                                 <div class="panel-heading">
                                     <h3 class="panel-title"><strong>GUIDE TO CLAIMING OR VERIFYING A MINISTRY</strong></h3>
                                 </div>
                                 <div class="panel-body" style="color: #000">
                                     <section>
                                         <p> We want people to find your Ministry easily, because Verified/Claimed Ministries are displayed at the top of search results. Also, if You have a Headquarter Ministry, you can add your branch ministries so that people can easily find all your ministries</p>
                                         <p>You can Claim This Ministry in any of the following ways :</p>
                                         <ul>

                                             <li>Upload a letter Headed document requesting Approval of Your Ministry <strong><i>Your Documents will be kept Confidential</i></strong></li>

                                             <li>Send a Message from your official Facebook Page to our <a href="{{ $fb_page }}">Facebook Page</a> stating the Ministry name and code you wish to claim. You will receive a reply as soon as possible</li>
                                             <li>Share Your Ministry Page on your Facebook, Twitter or Instagram page. This requires that you have a minimum of 100 followers and the page name and description must correspond. Then Send a message to our <a href="{{ $fb_page }}">Facebook Page</a> so that we can verify as soon as possible </li>

                                             <li>If you have any enquiries. Please send us a message on Facebook or use our <a target="_blank" href="{{ route('contact') }}"> Contact Form</a> or call us on 07068149559, 08027444825</li>

                                         </ul>
                                     </section>

<section>
    <div class="text-center">
        <form method="post" enctype="multipart/form-data" action="{{ route('verify_ministry', Fam::hash($min->id)) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="claim_file">Upload Document <strong><i>PDF OR IMAGE</i></strong></label>

                <input required name="claim_file" id="claim_file" type="file" class="file" data-show-upload="true" data-show-caption="false" data-show-remove="true"  accept="image/jpeg,image/png, application/pdf" data-browse-class="btn btn-danger" data-browse-label="Upload Document">
                <figure class="note"><strong>Hint:</strong> Max File Size 2MB</figure>
            </div>


        </form>
    </div>
</section>
                                 </div>
                             </div>


                         </div>
                     </div>
                @endif





            </div>

            <div class="col-md-3 col-sm-3">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
@endsection