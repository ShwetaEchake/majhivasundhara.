<header class="main-nav">
    <nav class="h-100">
        <div class="main-navbar h-100">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav" class="h-100">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General </h6>
                        </div>
                    </li>
                    @can('dashboard.view')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{ request()->routeIs('dashboard') ? 'active-bg' : '' }}" href="{{ route('dashboard') }}">
                                <i data-feather="home"></i><span>Dashboard</span></a>
                        </li>
                    @endcan

                    @can('wards.view')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{ request()->routeIs('wards.index') ? 'active-bg' : '' }}" href="{{ route('wards.index') }}">
                                <i data-feather="archive"></i><span>Wards</span>
                            </a>
                        </li>
                    @endcan

                    @can('questions.view')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{ request()->routeIs('questions.index') ? 'active-bg' : '' }}" href="{{ route('questions.index') }}">
                                <i data-feather="help-circle"></i><span>Questions</span>
                            </a>
                        </li>
                    @endcan

                    @can(['roles.view'])
                        <li class="dropdown">
                            <a class="nav-link menu-title" href="javascript:void(0)">
                                <i data-feather="user"></i><span>Accessor Management</span>
                            </a>
                            <ul class="nav-submenu menu-content">
                                @can('users.view')
                                    <li><a href="{{ route('users.index') }}">Accessors </a></li>
                                @endcan
                                @can('roles.view')
                                    <li><a href="{{ route('roles.index') }}">Roles </a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    @can('contestents.view')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{ request()->routeIs('contestents.index') ? 'active-bg' : '' }}" href="{{ route('contestents.index') }}">
                                <i data-feather="user-plus"></i><span>All Contestents</span>
                            </a>
                        </li>
                    @endcan


                    @can(['paryavaran-spardha.view'])
                        <li class="dropdown">
                            <a class="nav-link menu-title" href="javascript:void(0)">
                                <i data-feather="alert-circle"></i><span>Paryavaran Spardha</span>
                            </a>
                            <ul class="nav-submenu menu-content">
                                {{-- @can('forms.pending') --}}
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('forms.index', ['category'=> $category->id, 'page_type'=> 0]) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                {{-- @endcan --}}
                            </ul>
                        </li>
                    @endcan


                    @can(['janjagruti-spardha.view'])
                        <li class="dropdown">
                            <a class="nav-link menu-title" href="javascript:void(0)">
                                <i data-feather="file-text"></i><span>Janjagruti Spardha</span>
                                {{-- <i data-feather="file-text"></i><span>जनजागृती स्पर्धा</span> --}}
                            </a>
                            <ul class="nav-submenu menu-content">
                                {{-- @can('users.view') --}}
                                    <li><a href="{{ route('contest-form-two.index', ['mode'=> '0']) }}">Individual </a></li>
                                {{-- @endcan --}}
                                {{-- @can('roles.view') --}}
                                    <li><a href="{{ route('contest-form-two.index', ['mode'=> '1']) }}">Society </a></li>
                                {{-- @endcan --}}
                            </ul>
                        </li>
                    @endcan


                    @role('Field Accessor')

                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav {{ request()->routeIs('field.dashboard') ? 'active-bg' : '' }}" href="{{ route('field.dashboard') }}">
                                <i data-feather="home"></i><span>Dashboard</span></a>
                        </li>

                        @can('dept-wise-forms.view')
                            <li class="dropdown">
                                <a class="nav-link menu-title" href="javascript:void(0)">
                                    <i data-feather="file-text"></i><span>Dept. Wise Forms</span>
                                </a>
                                <ul class="nav-submenu menu-content">
                                    @foreach($wards as $ward)
                                        <li><a href="{{ route('field.ward.forms', $ward->id) }}">{{$loop->iteration}}- {{ $ward->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endcan
                    @endrole

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ request()->routeIs('show-change-password') ? 'active-bg' : '' }}" href="{{ route('show-change-password') }}">
                            <i data-feather="lock"></i><span>Change Password</span>
                        </a>
                    </li>


                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ request()->routeIs('logout') ? 'active-bg' : '' }}" onclick="event.preventDefault(); document.getElementById('side-logout-form').submit();" href="{{ route('logout') }}">
                            <i data-feather="log-out"></i><span>Logout</span>
                        </a>
                        <form id="side-logout-form" action="{{ auth()->user()->hasRole(['Field Accessor']) ? route('field.logout') : route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
