<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i></div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" src="images/user.png" width="70" height="70"/></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold">{{ Auth::user()->email }}</strong></span>
                            <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li>
                            <a href="{{ route('_users.password.reset') }}" class="J_menuItem" href="" data-index="0">
                                {{ __('Reset Password') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">PACK</div>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa fa-truck"></i>
                    <span class="nav-label">{{__('Package Manage')}}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">{{__('Packages')}}</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="" data-index="0">{{__('Package Sign')}}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa  fa-bar-chart"></i>
                    <span class="nav-label">{{__('Report Manage')}}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">{{__('Package Report')}}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-dollar"></i>
                    <span class="nav-label">{{__('Finance Manage')}}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">{{__('My Product')}}</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="" data-index="0">{{__('Package Confirm')}}</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="" data-index="0">{{__('Product Service')}}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa  fa-cog"></i>
                    <span class="nav-label">{{__('Basic data Manage')}}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{route('logistics_companies.index')}}" data-index="0">{{__('Logistics Companies')}}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">{{__('User Manage')}}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{route('_users.index')}}" data-index="0">{{__('Users')}}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!--左侧导航结束-->