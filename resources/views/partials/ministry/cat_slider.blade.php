<div class="categories">
    @foreach($min_cats as $mc)
        <div class="panel panel-body border-top-{{ Fam::getRandomBGColor() }} text-center">
            <h3 class="no-margin" style="font-weight: bold">{{ $mc->name }}</h3>
            <hr>
            <a href="{{ route('categories', $mc->slug) }}" class="btn bg-{{ Fam::getRandomBGColor() }}"><i class="fa fa-bars position-left"></i> View Ministries</a>
        </div>
    @endforeach
</div>