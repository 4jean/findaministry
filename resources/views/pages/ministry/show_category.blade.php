@extends('layouts.front.master')

@section('bc', Breadcrumbs::render('show_category', $min_cat_name))

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-sm-9">
                <header><h2>Ministries in The {{ $min_cat_name }} Category</h2></header>

                <section id="properties">

                    @if(!$mins->count())
                        <div class="alert alert-warning text-center">There are No Ministries in The {{ $min_cat_name }} Category</div>
                        @endif

                        <div class="grid">
                            @foreach($mins as $min)

                                <div class="property masonry">
                                    <div class="inner">
                                        <a href="{{ $min->url }}">
                                            <div class="property-image">

                                                @if($min->verified)
                                                    <figure class="tag status">
                                                        <i title="Verified" class="fa fa-check"></i>
                                                    </figure>
                                                @endif

                                                @if($min->hq)
                                                    <figure  class="hq">
                                                        <i title="Headquarters"  class="fa fa-home"></i>
                                                    </figure>
                                                @endif

                                                <div class="overlay">
                                                    <div class="info">
                                                        <div class="tag price">{{ $min->code }}</div>
                                                    </div>
                                                </div>
                                                <img alt="{{ $min->name }}" src="{{ $min->photo }}">
                                            </div>
                                        </a>
                                        <aside>

                                            <header>
                                                <a href="{{ $min->url }}"><h3>{{ str_limit($min->name, 60) }}</h3></a>
                                                @if($min->country_code == 'NG')

                                                    <figure>{{ $min->lga->name.', '.$min->state->name.' State'.'. '.$min->country }}</figure>
                                                @endif
                                            </header>


                                            <dl>
                                                <dt>Founder:</dt>
                                                <dd>{{ $min->founder }}</dd>
                                                <dt>Category:</dt>
                                                <dd>{{ $min->min_cat->name }}</dd>
                                                <dt>Phone:</dt>
                                                <dd>{{ $min->phone1 }}</dd>

                                                @if($min->website)
                                                    <dt>Website</dt>
                                                    <dd><a href="{{ $min->website }}" target="_blank">{{ str_limit($min->website, 27) }}</a></dd>
                                                @endif

                                                @if($min->fb)
                                                    <dt>Facebook</dt>
                                                    <dd><a target="_blank" href="{{ $min->fb }}">{{ str_limit($min->fb, 27) }}</a></dd>
                                                @endif

                                                @if($min->postal_code)
                                                    <dt>Postal Code</dt>
                                                    <dd>{{ $min->postal_code }}</dd>
                                                @endif
                                            </dl>
                                            <a href="{{ $min->url }}" class="link-arrow">Read More</a>
                                        </aside>
                                    </div>
                                </div>

                            @endforeach
                        </div>


                    {{--Pagination--}}
                    <div class="center">
                        {{ $mins->links() }}
                    </div>
                </section>
            </div>



            <div class="col-md-3 col-sm-3">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
@endsection