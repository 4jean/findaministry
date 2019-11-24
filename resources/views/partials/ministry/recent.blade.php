<section id="properties">

    @foreach($rcms->limit(8)->get()->chunk(4) as $chunk)

        <div class="row">
            @foreach($chunk as $min)
                <div class="col-md-3 col-sm-6">
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

                        <a itemprop="url" href="{{ $min->url }}">
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
                                            {{ $min->state.'. '.$min->country_code}}
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

        @endforeach

</section>
