<div class="navigation">
    <div class="secondary-navigation">
        <div class="container">
            <div class="contact">
                <figure><strong>Phone:</strong>{{ Fam::getSetting('phone1') }}</figure>
                <figure><strong>Get In Touch:</strong>
                    <a href="{{ route('contact') }}"> Send Us A Message</a></figure>
            </div>
            <div class="user-area">
                <div class="actions">

                    @guest
                    <a href="{{ route('register') }}" class="promoted"><strong>Register</strong></a>
                    <a href="{{ route('login') }}">Sign In</a>
                    @endguest

                    @auth
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('cj') }}" class="promoted"><strong>Admin Panel</strong></a>
                        @endif

                    <a href="{{ route('my_account') }}" class="promoted"><strong>My Account</strong></a>
                    @endauth

                    <a href="{{ $fb_page }}"><strong><i class="fa fa-facebook"></i>acebook Page</strong></a>
                </div>
                {{--   <div class="language-bar">
                       <a href="#" class="active"><img src="assets/img/flags/gb.png" alt=""></a>
                   </div>--}}
            </div>
        </div>
    </div>
    <div class="container">
        <header class="navbar" id="top" role="banner">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand nav" id="brand">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}"
                                                       alt="{{ Fam::getSystemName() }}"></a>
                </div>
            </div>

            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                <ul class="nav navbar-nav">
                    <li class="{{ $page_title == 'Home' ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="has-child {{ ( Route::is('ministries') || Route::is('categories')) ? 'active' : '' }}"><a
                                href="#">Ministries</a>
                        <ul class="child-navigation">
                            <li><a href="{{ route('ministries') }}">All Ministries</a></li>
                            <li><a href="{{ route('categories') }}">Categories</a></li>
                        </ul>
                    </li>

                    <li class="{{ Route::is('search') ? 'active' : '' }}"><a href="{{ route('search') }}">Search</a>
                    </li>
                    <li class="{{ Fam::activePageIs('add_ministry') ? 'active' : '' }}"><a
                                href="{{ route('add_ministry') }}">Add Ministry</a></li>
                    <li class="{{ Route::is('guides') ? 'active' : '' }}"><a href="{{ route('guides') }}">Guides</a>
                    </li>
                    <li class="{{ Route::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="{{ Route::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </nav>

            <div class="add-your-property">
                <a href="{{ route('add_ministry') }}" class="btn btn-success"><i class="fa fa-plus"></i><span
                            class="text">Add Your Ministry</span></a>
            </div>
        </header>
    </div>
</div>