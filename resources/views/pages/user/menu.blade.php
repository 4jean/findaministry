<section id="sidebar">
    <header><h3>{{ $page_title }}</h3></header>
    <aside>
        <ul class="sidebar-navigation">

            <li data-toggle="collapse" data-target="#submenu1"  class="has-child "><a href="#"><i class="fa fa-home"></i><span>My Ministries</span> <i class="caret pull-right" style="margin-top: 10px" ></i></a>

            <ul id="submenu1" class="child-navigation collapse">

                <li class="{{ Fam::activePageIs('my_ministries') ? 'active' : '' }} "><a href="{{ route('my_ministries') }}"><span>Manage Ministries</span></a></li>

                <li class="{{ Fam::activePageIs('my_bookmarks') ? 'active' : '' }}"><a href="{{ route('my_bookmarks') }}"><span>Bookmarked Ministries</span></a></li>

                {{-- Manage Branches if You Have HQ--}}
                @if(Fam::userHasMinHQ())
                    <li><a href=""><span>Manage Branches</span></a></li>
                @endif
            </ul>
            </li>


            <li data-toggle="collapse" data-target="#submenu2"  class="has-child"><a href="#"><i class="fa fa-youtube-play"></i><span>My Media <i class="caret pull-right" style="margin-top: 10px"></i></span></a>

                <ul id="submenu2" class="child-navigation collapse">
                    <li class=""><a href=""><span>Youtube Videos</span></a></li>
                    <li><a class=""><span>Audio Channels</span></a></li>
                    <li><a class=""><span>Articles &amp; Books</span></a></li>

                </ul>
            </li>

            <li class="{{ Fam::activePageIs('my_profile') ? 'active' : '' }}"><a href="{{ route('my_profile') }}"><i class="fa fa-user"></i><span>Profile</span></a></li>

            <li><a id="logout-link" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>

        </ul>
    </aside>
    <form class="hidden" id="logout" method="post" action="{{ route('logout') }}">
        {{ csrf_field() }}
    </form>

</section>