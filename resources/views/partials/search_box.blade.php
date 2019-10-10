<div class="search-box-wrapper">
    <div class="search-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-offset-9 col-sm-4 col-sm-offset-8">
                    <div class="search-box map">

                        <form method="post" action="{{ route('search.post') }}" role="form" id="form-map" class="form-map form-search">
                            <h2 style="color: #fff;">{{ config('app.name') }}</h2>
{{ csrf_field() }}
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
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <select name="country_code" id="ajax_country_code" title="Select Country"  data-live-search="true">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $code => $country)
                                        <option {{ old('country_code') === $code ? 'selected' : '' }} value="{{ $code }}">{{ $country}}</option>
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <select id="ajax_state" title="Select State"  data-live-search="true" name="state">
                                    <option value="">Select State</option>
                                </select>
                            </div>
                            <div class="form-group">
                                    <input  type="text" name="city" placeholder="City">
                            </div>
                            <div class="form-group">
                                    <input  type="text" name="postal_code" placeholder="Postal Code">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Search Now</button>
                            </div><!-- /.form-group -->
                        </form><!-- /#form-map -->
                    </div><!-- /.search-box.map -->
                </div><!-- /.col-md-3 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.search-box-inner -->
</div>
