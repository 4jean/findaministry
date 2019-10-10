<section id="results">
    <header><h1>Find Ministries (Recent Searches)</h1></header>

    <section id="search-filter">
        <figure><h3><i class="fa fa-search"></i>Search Results:</h3>
            <span class="search-count">{{ count(session('mins')) }}</span>

        </figure>
    </section>

    <section id="properties">

        <div class="grid">
            @foreach(session('mins') as $min)

                <div class="property masonry">
                    <div class="inner">
                        <a href="{{ $min->url }}">
                            {{--Ministry Photo--}}
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
                                <img title="{{ $min->name.', '.$min->state.'. '.$min->country }}" alt="{{ $min->name }}" src="{{ $min->photo }}">
                            </div>
                        </a>
                        <aside>

                            {{--Ministry Name, Address, Location--}}
                            <header>
                                <a title="{{ $min->name.', '.$min->state.'. '.$min->country }}" href="{{ $min->url }}"><h3>{{ Str::limit($min->name, 60) }}</h3></a>
<figure>{{ Str::limit($min->address, 40) }}</figure>
                                <figure>{{ $min->state.' '.$min->country_code }}</figure>
                            </header>


                            <dl>
                                <dt>Founder:</dt>
                                <dd>{{ $min->founder }}</dd>
                                <dt>Category:</dt>
                                <dd><a href="{{ route('categories', $min->min_cat->slug) }}">{{ $min->min_cat->name }}</a></dd>
                                <dt>Phone:</dt>
                                <dd>{{ $min->phone1 }}</dd>

                                @if($min->website)
                                    <dt>Website</dt>
                                    <dd><a href="{{ $min->website }}" target="_blank">{{ Str::limit($min->website, 27) }}</a></dd>
                                @endif

                                @if($min->fb)
                                    <dt>Facebook</dt>
                                    <dd><a target="_blank" href="{{ $min->fb }}">{{ Str::limit($min->fb, 27) }}</a></dd>
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
         {{ session('mins')->links() }}
        </div>
    </section>
</section>
