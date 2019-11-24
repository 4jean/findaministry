<div class="row">
    @foreach($random_mins->limit(16)->get() as $rand_min)
            <div class="col-md-3 col-sm-6">
                <div itemscope="" itemtype="http://schema.org/Organization" class="property equal-height">

                    @if($rand_min->verified)
                        <figure class="tag status">
                            <i title="Verified" class="fa fa-check"></i>
                        </figure>
                    @endif

                    @if($rand_min->hq)
                        <figure  class="hq">
                            <i title="Headquarters"  class="fa fa-home"></i>
                        </figure>
                    @endif

                    <a itemprop="url" href="{{ $rand_min->url }}">
                        <div class="property-image">
                            <img itemprop="image" alt="{{ $rand_min->name }}" src="{{ $rand_min->photo }}">
                        </div>
                        <div class="overlay">
                            <div class="info">
                                <div style="background-color: #0b0b0b" class="tag price">{{ $rand_min->code }}</div>
                                <h3 title="{{ $rand_min->name }}" itemprop="name">{{ Str::limit($rand_min->name, 27) }}</h3>
                                <figure>{{ Str::limit($rand_min->address, 27) }}</figure>
                            </div>
                            <ul class="additional-info">
                                <figure><strong>Location</strong></figure>

                                <figure>
                                    {{ $rand_min->state.'. '.$rand_min->country_code}}
                                </figure>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>
    @endforeach
</div>
