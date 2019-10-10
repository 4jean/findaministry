@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('show_ministry', $min))

@section('content')

    <div class="container">
        <div class="row">

           {{-- Ministry Detail Content--}}
            <div class="col-md-9 col-sm-9">

                <section itemscope itemtype="http://schema.org/Organization" id="property-detail">

                    <header class="property-title">
                        <h1>
                            <span style="font-weight: bold" itemprop="name">{{ $min->name }}</span>

                        @if($min->hq)<i class="fa fa-home" title="Headquarters"></i> @endif
                        </h1>

                        <figure>
                                <dd itemprop="address">{{ $min->address.', '.$min->state.' '.$min->country }}</dd>
                        </figure>

                            <span class="actions">

                               @auth {{--Show Bookmarked Status--}}
                                <i style="font-size: 18px; color:#1396e2; float: right" data-min-id="{{ Fam::hash($min->id) }}" data-fav="{{ $min_is_fav }}" title="{{ $min_is_fav ? 'Remove Bookmark' : 'Bookmark This Ministry' }}" class="fav fa {{ $min_is_fav ? 'fa-star' : 'fa-star-o' }}"></i>
                                @endauth

                            </span>
                    </header>

                    <section id="property-gallery">
                        <div class="owl-carousel property-carousel">
                            <div class="property-slide">
                                <a title="{{ $min->name.', '.$min->state.'. '.$min->country }}" href="{{ $min->photo }}" class="image-popup">
                                    <div  class="overlay"><h3>Front View</h3></div>
                                    <img itemprop="image" style="max-height: 400px" alt="{{ Str::limit($min->name) }}" src="{{ $min->photo }}">
                                </a>
                            </div>

                        </div>
                    </section>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <section id="quick-summary" class="clearfix">
                                <header><h2>Quick Summary</h2></header>
                                <dl>
                                    @if($min->city)
                                        <dt>City</dt>
                                        <dd>{{ $min->city }}</dd>
                                    @endif

                                    @if($min->postal_code)
                                        <dt>Postal Code</dt>
                                        <dd>{{ $min->postal_code }}</dd>
                                    @endif

                                    @if($min->state)
                                        <dt>State</dt>
                                        <dd>{{ $min->state }}</dd>
                                    @endif


                                    <dt>Country</dt>
                                    <dd>{{ $min->country }}</dd>

                                    @if($min->fb)
                                    <dt>Facebook</dt>
                                    <dd><a itemprop="sameAs" target="_blank" href="{{ $min->fb }}">Facebook</a></dd>
                                    @endif

                                    @if($min->tw)
                                        <dt>Twitter</dt>
                                        <dd><a itemprop="sameAs" target="_blank" href="{{ $min->tw }}">Twitter</a></dd>
                                    @endif

                                    @if($min->yt)
                                        <dt>Youtube</dt>
                                        <dd><a itemprop="sameAs" target="_blank" href="{{ $min->yt }}">Youtube</a></dd>
                                    @endif

                                    @if($min->inst)
                                        <dt>Instagram</dt>
                                        <dd><a itemprop="sameAs" target="_blank" href="{{ $min->inst }}">Instagram</a></dd>
                                    @endif

                                    @if($min->email)
                                        <dt>Email</dt>
                                        <dd itemprop="email">{!! Fam::show_email(Str::limit($min->email, 27)) !!}</dd>
                                    @endif

                                    @if($min->phone1)
                                        <dt>Phone</dt>
                                        <dd itemprop="telephone">{{ $min->phone1 }}</dd>
                                    @endif

                                    @if($min->phone2)
                                        <dt>Mobile</dt>
                                        <dd>{{ $min->phone2 }}</dd>
                                    @endif

                                    @if($min->website)
                                    <dt>Website</dt>
                                    <dd><a itemprop="url" href="{{ $min->website }}" target="_blank">{{ Str::limit($min->website, 25) }}</a></dd>
                                    @endif

                                    @if($min->founder)
                                    <dt>Founder</dt>
                                    <dd itemprop="founder" itemscope="" itemtype="http://schema.org/Person"><strong itemprop="name">{{ $min->founder }}</strong></dd>
@endif
                                    <dt>Ministry Category</dt>
                                    <dd><a href="{{ route('categories', $min->min_cat->slug) }}">{{ $min->min_cat->name }}</a></dd>

                                    <dt>Ministry Code</dt>
                                    <dd><span class="tag" style="background-color: purple; font-weight: bold;; color: #fff">{{ $min->code }}</span></dd>
                                    @if($min->verified)
                                        <dt>Verified</dt>
                                        <dd> <span style="color:green"><i class="fa fa-check"></i> YES</span></dd>

                                        @endif
                                </dl>
                                @if(!$min->verified)
                                <a href="{{ route('claim_ministry', Fam::hash($min->id)) }}" class="btn btn-block btn-default"> Claim Ownership of This Ministry</a>
                                    @endif

                            </section>
                        </div>{{--<!-- /.col-md-4 END SUMMARY -->--}}

                        <div class="col-md-8 col-sm-12">
                            <section class="description">
                                <header><h2>Ministry Description</h2></header>
                      {!! $min->description !!}
                            </section>


                        </div>
                        </div>

                    {{--Min Branches if any--}}
                    <div class="row">
                        <div class="col-md-12 col-sm-12">

                            @include('partials.ministry.branches')

                            <hr class="thick">

                        </div>
                    </div>


                </section> {{--END Ministry Detail--}}

                    </div>

            {{--   <!-- sidebar -->--}}
            <div class="col-md-3 col-sm-3">
                @include('partials.sidebar')
            </div>
            {{--  <!-- end Sidebar -->--}}

        </div>{{--<!-- /.row -->--}}

        {{--Recent Ministries--}}
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <header class="section-title">
                    <h2>Recent Ministries </h2>
                    <a href="{{ route('ministries') }}" class="link-arrow">All Ministries</a>
                </header>
                @include('partials.ministry.recent')

                <hr class="thick">

            </div>
        </div>
    </div>

    @endsection
