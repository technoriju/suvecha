<body>
    <!-- Pre-loader start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

   <nav class="pcoded-navbar">

        <div class="navbar-wrapper">

            <div class="navbar-brand header-logo">

                <a href="{{url('/manage/dashboard')}}" class="b-brand">

                    <div class="b-bg">

                        <!-- <img src="{{ url('assets/manage/images/logo-thum.png') }}" alt=""> -->

                    </div>

                    <span class="b-title">Pharmacy Management</span>

                </a>

                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>

            </div>

            <div class="navbar-content scroll-div">

                <ul class="nav pcoded-inner-navbar">

                    <li class="nav-item pcoded-menu-caption">

                        <label>Navigation</label>

                    </li>

                    <li data-username="" class="nav-item {{(Request::segment(2) == 'dashboard') ? 'active':''}}">

                        <a href="{{url('/manage/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>

                    </li>

                    <li data-username="" class="nav-item pcoded-hasmenu {{(Request::segment(2) == 'headquarter') ? 'active pcoded-trigger':''}}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Headquarter</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{url('/manage/headquarter/create')}}" class="">Add Headquarter</a></li>
                            <li class=""><a href="{{url('/manage/headquarter')}}" class="">Headquarter List</a></li>
                            <li class=""><a href="{{url('/manage/headquarter/distance')}}" class="">Headquarter Distance</a></li>
                        </ul>
                    </li>

                    <li data-username="" class="nav-item pcoded-hasmenu {{(Request::segment(2) == 'area') ? 'active pcoded-trigger':''}}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Area</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{url('/manage/area/create')}}" class="">Add Area</a></li>
                            <li class=""><a href="{{url('/manage/area')}}" class="">Area List</a></li>
                        </ul>
                    </li>

                    <li data-username="" class="nav-item pcoded-hasmenu {{(Request::segment(2) == 'specialization') ? 'active pcoded-trigger':''}}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Specialization</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{url('/manage/specialization/create')}}" class="">Add Specialization</a></li>
                            <li class=""><a href="{{url('/manage/specialization')}}" class="">Specialization List</a></li>
                        </ul>
                    </li>

                    <li data-username="" class="nav-item pcoded-hasmenu {{(Request::segment(2) == 'medicine') ? 'active pcoded-trigger':''}}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Medicine</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{url('/manage/medicine/create')}}" class="">Add Medicine</a></li>
                            <li class=""><a href="{{url('/manage/medicine')}}" class="">Medicine List</a></li>
                        </ul>
                    </li>

                    <li data-username="" class="nav-item pcoded-hasmenu {{(Request::segment(2) == 'employee') ? 'active pcoded-trigger':''}}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Employee</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{url('/manage/employee/create')}}" class="">Add Employee</a></li>
                            <li class=""><a href="{{url('/manage/employee')}}" class="">Employee List</a></li>
                        </ul>
                    </li>

                    <li data-username="" class="nav-item {{(Request::segment(2) == 'role') ? 'active':''}}">

                        <a href="{{url('/manage/role')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Role</span></a>

                    </li>

                    <li data-username="" class="nav-item {{(Request::segment(2) == 'ta-bill') ? 'active':''}}">

                        <a href="{{url('/manage/ta-bill')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Ta Bill</span></a>

                    </li>

                    {{-- <li data-username="" class="nav-item pcoded-hasmenu ">

                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-credit-card"></i></span><span class="pcoded-mtext">RGB Product Entry</span></a>

                        <ul class="pcoded-submenu">

                            <li class=""><a href="add-rgb.php" class="">RGB Product Entry</a></li>
                            <li class=""><a href="stock-rgb.php" class="">Stock RGB Product</a></li>

                        </ul>

                    </li> --}}

                </ul>

            </div>

        </div>

    </nav>

<header class="navbar pcoded-header navbar-expand-lg navbar-light">

        <div class="m-header">

            <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>

            <a href="index.html" class="b-brand">

                   <div class="b-bg">

                       <i class="feather icon-trending-up"></i>

                   </div>

                   <span class="b-title">Office Management</span>

               </a>

        </div>

        <a class="mobile-menu" id="mobile-header" href="javascript:">

            <i class="feather icon-more-horizontal"></i>

        </a>

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav mr-auto">

                <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>

                <li class="nav-item dropdown">

                    <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown">Dropdown</a>

                    <!-- <ul class="dropdown-menu">

                        <li><a class="dropdown-item" href="javascript:">Action</a></li>

                        <li><a class="dropdown-item" href="javascript:">Another action</a></li>

                        <li><a class="dropdown-item" href="javascript:">Something else here</a></li>

                    </ul> -->

                </li>

                <li class="nav-item">

                    <div class="main-search">

                        <div class="input-group">

                            <input type="text" id="m-search" class="form-control" placeholder="Search . . .">

                            <a href="javascript:" class="input-group-append search-close">

                                <i class="feather icon-x input-group-text"></i>

                            </a>

                            <span class="input-group-append search-btn btn btn-primary">

                                <i class="feather icon-search input-group-text"></i>

                            </span>

                        </div>

                    </div>

                </li>

            </ul>

            <ul class="navbar-nav ml-auto">

                <li>

                    <div class="dropdown">

                        <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>

                        <div class="dropdown-menu dropdown-menu-right notification">

                            <div class="noti-head">

                                <h6 class="d-inline-block m-b-0">Notifications</h6>

                                <div class="float-right">

                                    <a href="javascript:" class="m-r-10">mark as read</a>

                                    <a href="javascript:">clear all</a>

                                </div>

                            </div>

                            <ul class="noti-body">

                                <li class="n-title">

                                    <p class="m-b-0">NEW</p>

                                </li>

                                <li class="notification">

                                    <div class="media">

                                        <img class="img-radius" src="{{ url('assets/manage/images/user/avatar-1.jpg') }}" alt="Generic placeholder image">

                                        <div class="media-body">

                                            <p><strong>Pharmacy</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>

                                            <p>New ticket Added</p>

                                        </div>

                                    </div>

                                </li>

                                <li class="n-title">

                                    <p class="m-b-0">EARLIER</p>

                                </li>

                                <li class="notification">

                                    <div class="media">

                                        <img class="img-radius" src="{{ url('assets/manage/images/user/avatar-2.jpg') }}" alt="Generic placeholder image">

                                        <div class="media-body">

                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>

                                            <p>Prchace New Theme and make payment</p>

                                        </div>

                                    </div>

                                </li>

                                <li class="notification">

                                    <div class="media">

                                        <img class="img-radius" src="{{ url('assets/manage/images/user/avatar-3.jpg') }}" alt="Generic placeholder image">

                                        <div class="media-body">

                                            <p><strong>pharmacy</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>

                                            <p>currently login</p>

                                        </div>

                                    </div>

                                </li>

                            </ul>

                            <div class="noti-footer">

                                <a href="javascript:">show all</a>

                            </div>

                        </div>

                    </div>

                </li>

                <li>

                    <div class="dropdown drp-user">

                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">

                            <i class="icon feather icon-settings"></i>

                        </a>

                        <div class="dropdown-menu dropdown-menu-right profile-notification">

                            <div class="pro-head">

                                <img src="{{ url('assets/manage/images/user/avatar-1.jpg') }}" class="img-radius" alt="User-Profile-Image">

                                <span>Pharmacy</span>

                                <a href="javascript:" class="dud-logout" title="Logout">

                                    <i class="feather icon-log-out"></i>

                                </a>

                            </div>

                            <ul class="pro-body">

                               <!--  <li><a href="javascript:" class="dropdown-item"><i class="feather icon-settings"></i> Settings</a></li>

                                <li><a href="javascript:" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>

                                <li><a href="javascript:" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>

                                <li><a href="javascript:" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li> -->

                                <li><a href="{{url('/manage/logout')}}" class="dropdown-item"><i class="feather icon-lock"></i> Log out</a></li>

                            </ul>

                        </div>

                    </div>

                </li>

            </ul>

        </div>

    </header>
