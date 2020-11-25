<div class="header top-header hor-topheader" style="z-index: 99;">
    <div id="particles-js" class="zindex1"></div>
    <div class="container">
        <div class="d-flex header-nav">
            <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
            <div class="color-headerlogo">
                <a class="header-desktop" href="{{ url('/dashboard') }}"></a>
                <a class="header-mobile" href="{{ url('/dashboard') }}"></a>
            </div>

            <a class="header-brand header-brand2 d-none d-lg-block  align-items-center justify-content-center" href="index.html">
                <a class="header-desktop" href="{{ url('/dashboard') }}"></a>
            </a>
            <div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon">
                <div class="dropdown  search-icon">
                    <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch">
                        <i class="fe fe-search"></i>
                    </a>
                </div>
                <div class="dropdown  header-fullscreen">
                    <a class="nav-link icon full-screen-link nav-link-bg" id="fullscreen-button">
                        <i class="fe fe-minimize"></i>
                    </a>
                </div>
                {{-- <div class="dropdown  notifications">
                    <a class="nav-link icon" data-toggle="dropdown">
                        <i class="fe fe-bell"></i>
                        <span class="pulse bg-danger"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a href="#" class="dropdown-item mt-2 d-flex pb-3">
                            <div class="notifyimg bg-info">
                                <i class="fa fa-thumbs-o-up"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Someone likes our posts.</h6>
                                <div class="small text-muted">3 hours ago</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex pb-3">
                            <div class="notifyimg bg-warning">
                                <i class="fa fa-commenting-o"></i>
                            </div>
                            <div>
                                <h6 class="mb-1"> 3 New Comments</h6>
                                <div class="small text-muted">5 hour ago</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex pb-3">
                            <div class="notifyimg bg-danger">
                                <i class="fa fa-cogs"></i>
                            </div>
                            <div>
                                <h6 class="mb-1"> Server Rebooted.</h6>
                                <div class="small text-muted">45 mintues ago</div>
                            </div>
                        </a>
                        <div class="border-top">
                            <a href="#" class="dropdown-item text-center">View all Notification</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown  message">
                    <a class="nav-link icon text-center" data-toggle="dropdown">
                        <i class="fe fe-mail"></i>
                        <span class=" nav-unread badge badge-warning badge-pill">6</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a href="#" class="dropdown-item d-flex mt-2 pb-3">
                            <div class="avatar avatar-md brround mr-3 d-block cover-image" data-image-src="{{ asset('img/users/1.jpg') }}">
                <span class="avatar-status bg-green"></span>
            </div>
            <div>
                <h6 class="mb-1">Lucas Walsh</h6>
                <p class="mb-0 fs-13 ">Hey! there I' am available</p>
                <div class="small text-muted">3 hours ago</div>
            </div>
            </a>
            <a href="#" class="dropdown-item d-flex pb-3">
                <div class="avatar avatar-md brround mr-3 d-block cover-image" data-image-src="{{ asset('img/users/1.jpg') }}">
                    <span class="avatar-status bg-red"></span>
                </div>
                <div>
                    <h6 class="mb-1">Rebecca Short</h6>
                    <p class="mb-0 fs-13 ">New product Launching</p>
                    <div class="small text-muted">5 hour ago</div>
                </div>
            </a>
            <a href="#" class="dropdown-item d-flex pb-3">
                <div class="avatar avatar-md brround mr-3 d-block cover-image" data-image-src="{{ asset('img/users/1.jpg') }}">
                    <span class="avatar-status bg-yellow"></span>
                </div>
                <div>
                    <h6 class="mb-1">Nicola Vance</h6>
                    <p class="mb-0 fs-13">New Schedule Realease</p>
                    <div class="small text-muted">45 mintues ago</div>
                </div>
            </a>
            <div class="border-top">
                <a href="#" class="dropdown-item text-center">See all Messages</a>
            </div>
        </div>
    </div> --}}
    <div class="dropdown header-user">
        <a href="#" class="nav-link icon" data-toggle="dropdown">
            <span><img src="{{ asset('img/users/1.jpg') }}" alt="profile-user" class="avatar brround cover-image mb-0 ml-0"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <div class=" dropdown-header noti-title text-center border-bottom p-3">
                <div class="header-usertext">
                    <h5 class="mb-1">@if(Auth::user()->type == 'admin') Admin @else Customer @endif</h5>
                    <p class="mb-0">{{Auth::user()->email}}</p>
                </div>
            </div>
            <a class="dropdown-item" href="profile.html">
                <i class="mdi mdi-account-outline mr-2"></i> <span>My profile</span>
            </a>
            <a class="dropdown-item" href="#">
                <i class="mdi mdi-settings mr-2"></i> <span>Settings</span>
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mdi  mdi-logout-variant mr-2"></i> <span>Logout</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        </div>
    </div>
    <div class="dropdown  header-fullscreen">
        <a class="nav-link icon sidebar-right-mobile" data-toggle="sidebar-right" data-target=".sidebar-right">
            <i class="fe fe-align-right"></i>
        </a>
    </div>
</div>
</div>
</div>
</div>