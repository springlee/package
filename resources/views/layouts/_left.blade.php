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
                            <span class="block m-t-xs"><strong class="font-bold">{{ Auth::user()->name }}</strong></span>
                            <span class="text-muted text-xs block">{{$role_info}}<b class="caret"></b></span>
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
            @hasanyrole('Admin|Supplier|Merchandiser|Warehouseman|Package Manger')
            <li>
                <a href="#">
                    <i class="fa fa fa-truck"></i>
                    <span class="nav-label">{{__('Package Manage')}}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    @can('package_info_input')
                    <li>
                        <a class="J_menuItem" href="{{route("package.merchandiser.index")}}" data-index="0">{{__('Packages')}}</a>
                    </li>
                    @endcan
                    @can('package_receive')
                    <li>
                        <a class="J_menuItem" href="{{route("package.warehouseman.index")}}" data-index="0">{{__('Package Sign')}}</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endhasanyrole
            @can('report')
            <li>
                <a href="#">
                    <i class="fa  fa-bar-chart"></i>
                    <span class="nav-label">{{__('Report Manage')}}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{route('package.report.index')}}" data-index="0">{{__('Package Report')}}</a>
                        </li>
                </ul>
            </li>
            @endcan
            @can('finance')
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
            @endcan
            @hasanyrole('Package Manger|Admin')
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
            @endhasanyrole
            @hasrole('Admin')
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
            @endhasrole
        </ul>
    </div>
</nav>
<!--左侧导航结束-->