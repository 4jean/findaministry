<section id="results">
    <header><h1>Ministries</h1></header>

    {{--@include('partials.min_sort') // Include Min Sort--}}

    <section id="properties">

        @foreach($mins->chunk(3) as $chunk)

            <div class="row">
                @foreach($chunk as $min)

                    <div class="col-md-4 col-sm-4">
                        <div itemscope="" itemtype="http://schema.org/Organization" class="property equal-height">

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

                            <a title="{{ $min->name.', '.$min->state.'. '.$min->country }}" itemprop="url" href="{{ $min->url }}">
                                <div class="property-image">
                                    <img itemprop="image" alt="{{ $min->name }}" src="{{ $min->photo }}">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div style="background-color: #0b0b0b" class="tag price">{{ $min->code }}</div>
                                        <h3 itemprop="name">{{ Str::limit($min->name, 27) }}</h3>
                                        <figure>{{ Str::limit($min->address, 27) }}</figure>
                                    </div>
                                    <ul class="additional-info">
                                            <figure><strong>Location</strong></figure>

                                            <figure>
                                                {{ $min->state.' '.$min->country_code }}
                                                @auth
                                                @if(Route::is('my_bookmarks'))
                                                    <i style="font-size: 16px; float: right" data-min-id="{{ Fam::hash($min->id) }}" data-fav="true" title="Remove Bookmark" class="fav fa fa-star"></i>
                                                @else
                                                    <i style="font-size: 16px; float: right" data-min-id="{{ Fam::hash($min->id) }}" data-fav="{{ in_array($min->id, $my_fav_ids) }}" title="{{ in_array($min->id, $my_fav_ids) ? 'Remove Bookmark' : 'Bookmark This Ministry' }}" class="fav fa {{ in_array($min->id, $my_fav_ids) ? 'fa-star' : 'fa-star-o' }}"></i>
                                                @endif

                                                @endauth

                                            </figure>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($loop->index == 9)
          @include('partials.ministry.advert')
            @endif
        @endforeach         {{--Chunk End--}}


        {{--<!-- Pagination -->--}}
        <div class="center"> {{ $mins->links() }} </div>

    </section>{{--<!-- /#properties-->--}}
</section>
