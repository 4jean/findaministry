<footer id="page-footer">
    <div class="inner">
        <aside id="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <article>
                            <h3>About Us</h3>
                            <p>FIND A MINISTRY is a Platform for Finding Churches, Ministers, and Ministries and Helping them to Find You and Yours. Show your Ministry! Find Ministries!! Connect to Ministries!!!
                                We live in a world sworn to dismantle all barriers to information, connectivity, and information (or idea) sharing
                            </p>
                            <hr>
                            <a href="{{ route('about') }}" class="link-arrow">Read More</a>
                        </article>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <article>
                            <h3>Recent Ministries</h3>

                            @foreach($rcms->limit(2)->get() as $rcm)
                                <div class="property small">
                                    <a title="{{ $rcm->name.', '.$rcm->state.'. '.$rcm->country }}" href="{{ $rcm->url }}">
                                        <div class="property-image">
                                            <img title="{{ $rcm->name.', '.$rcm->state.'. '.$rcm->country }}" alt="{{ $rcm->name }}" src="{{ $rcm->photo }}">
                                        </div>
                                    </a>
                                    <div class="info">
                                        <a title="{{ $rcm->name.', '.$rcm->state.'. '.$rcm->country }}" href="{{ $rcm->url }}"><h4>{{ Str::limit($rcm->name, 35) }}</h4></a>
                                            <figure>{{ $rcm->state.' '.$rcm->country_code }} </figure>

                                        <div class="tag price">{{ $rcm->code }}</div>
                                    </div>
                                </div>
                            @endforeach

                        </article>
                    </div>{{--<!-- /.col-sm-3 -->--}}

                    <div class="col-md-3 col-sm-3">
                        <article>
                            <h3>Contact</h3>
                            <address>
                                <strong>{{ config('app.name') }}</strong><br>
                                P.O. Box 59,<br>
                                900008<br>
                                Karu Abuja, <br>
                                Nigeria.
                            </address>
                            +2348027444825<br>
                            +2347068149559<br>
                            <a href="{{ route('contact') }}"> Send Us A Message</a>
                        </article>
                    </div><!-- /.col-sm-3 -->

                    <div class="col-md-3 col-sm-3">
                        <article>
                            <h3>Useful Links</h3>
                            <ul class="list-unstyled list-links">
                                <li><a href="{{ route('search') }}">Search</a></li>
                                <li><a href="{{ route('ministries') }}">All Ministries</a></li>
                                <li><a href="{{ route('login') }}">Login and Register Account</a></li>
                                <li><a href="{{ route('guides') }}">Guides</a></li>
                                <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>

                                <li><a href="{{ route('terms_of_use') }}">Terms and Conditions</a></li>
                            </ul>
                        </article>
                    </div><!-- /.col-sm-3 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </aside><!-- /#footer-main -->
        <aside id="footer-thumbnails" class="footer-thumbnails"></aside><!-- /#footer-thumbnails -->
        <aside id="footer-copyright">
            <div class="container">
                <span>Copyright &copy; {{ date('Y') }}. All Rights Reserved.</span>
                <span class="pull-right"><a href="#page-top" class="roll">Go to top</a></span>
            </div>
        </aside>
    </div><!-- /.inner -->
</footer>
