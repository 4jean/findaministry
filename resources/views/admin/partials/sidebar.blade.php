<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="{{ Fam::getPlaceholderImage() }}" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div>
                    <i class="icon-menu" title="Main"></i></li>

                {{--Dashboard--}}
                <li class="nav-item">
                    <a href="{{ route('cj') }}" class="nav-link {{ Route::is('cj') ? 'active' : ''}}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{--Manage Ministries--}}
                <li class="nav-item">
                    <a href="{{ route('cj_ministries') }}" class="nav-link {{ Fam::currentPageIs(['cj_ministries', 'cj_edit_min']) ? 'active' : ''}}">
                        <i class="icon-home2"></i>
                        <span>Manage Ministries</span>
                    </a>
                </li>

                {{--Manage Claims--}}
                <li class="nav-item">
                    <a href="{{ route('cj_claims') }}" class="nav-link {{ Route::is('cj_claims') ? 'active' : ''}}">
                        <i class="icon-file-media"></i>
                        <span>Manage Claims</span>
                    </a>
                </li>

               {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Layouts</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="index.html" class="nav-link active">Default layout</a></li>
                        <li class="nav-item"><a href="../../../../layout_2/LTR/default/full/index.html"
                                                class="nav-link">Layout 2</a></li>
                        <li class="nav-item"><a href="../../../../layout_3/LTR/default/full/index.html"
                                                class="nav-link">Layout 3</a></li>
                        <li class="nav-item"><a href="../../../../layout_4/LTR/default/full/index.html"
                                                class="nav-link">Layout 4</a></li>
                        <li class="nav-item"><a href="../../../../layout_5/LTR/default/full/index.html"
                                                class="nav-link">Layout 5</a></li>
                        <li class="nav-item"><a href="../../../../layout_6/LTR/default/full/index.html"
                                                class="nav-link disabled">Layout 6 <span
                                    class="badge bg-transparent align-self-center ml-auto">Coming soon</span></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="changelog.html" class="nav-link">
                        <i class="icon-list-unordered"></i>
                        <span>Changelog</span>
                        <span class="badge bg-blue-400 align-self-center ml-auto">2.2</span>
                    </a>
                </li>--}}
                <!-- /main -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
