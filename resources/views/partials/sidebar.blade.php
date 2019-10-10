<section id="sidebar">

    <aside id="edit-search">
        <header><h3>Find Ministries</h3></header>

        <form method="post" action="{{ route('search.post') }}" role="form" id="form-sidebar" class="form-search">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="min_name" autocomplete="off" placeholder="Ministry Name">
            </div>
            <div class="form-group">
                <select name="min_cat_id">
                    <option value="">Category</option>
                    @foreach($min_cats as $min_cat)
                        <option {{ old('min_cat_id') ? 'selected' : '' }} value="{{ Fam::hash($min_cat->id) }}">{{ $min_cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{--Select Country--}}
            <div class="form-group">
                <select name="country_code" id="ajax_country_code" title="Select Country"  data-live-search="true">
                    <option value="">Select Country</option>
                    @foreach($countries as $code => $country)
                        <option {{ old('country_code') === $code ? 'selected' : '' }} value="{{ $code }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>

            {{--Select States--}}
            <div class="form-group">
                <select id="ajax_state" title="Select State"  data-live-search="true" name="state">
                    <option value="">Select State</option>
                </select>
            </div>

            {{--City--}}
            <div class="form-group">
                <input  type="text" name="city" placeholder="City">
            </div>

            {{--Postal Code--}}
            <div class="form-group">
                <input  type="text" name="postal_code" placeholder="Postal Code">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">Search Now</button>
            </div>

        </form>
    </aside>
    {{--Form End--}}

    <aside id="featured-properties">
        <header><h3>Recent Ministries</h3></header>

        @foreach($rcms->limit(5)->get() as $rcm)
        <div itemscope="" itemtype="http://schema.org/Organization" class="property small">
            <a itemprop="url" href="{{ $rcm->url }}">
                <div class="property-image">
                    <img itemprop="image" alt="{{ $rcm->name }}" src="{{ $rcm->photo }}">
                </div>
            </a>
            <div class="info">
                <a href="{{ $rcm->url }}"><h4 itemprop="name">{{ Str::limit($rcm->name, 35) }}</h4></a>
                    <figure>{{ $rcm->state.', '.$rcm->country }} </figure>
                <div class="tag price">{{ $rcm->code }}</div>
            </div>
        </div>
            @endforeach

    </aside>

    <aside id="our-guides">
        <header><h3>Our Guides</h3></header>

        @foreach($guides->get() as $guide)
        <a href="{{ route($guide->name) }}" class="universal-button">
            <figure class="fa fa-check"></figure>
            <span>{{ $guide->title }}</span>
            <span class="arrow fa fa-angle-right"></span>
        </a>
            @endforeach
    </aside>
</section>
