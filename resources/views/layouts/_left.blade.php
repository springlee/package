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
                            <a href="{{ route('user.password.reset') }}" class="J_menuItem" href="" data-index="0">
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
                    <span class="nav-label">快递包裹管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">快递包裹列表</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="" data-index="0">快递包裹签收</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa  fa-bar-chart"></i>
                    <span class="nav-label">报表管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">快递包裹报表</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-dollar"></i>
                    <span class="nav-label">财务管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">我的产品</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="" data-index="0">快递包裹确认</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="" data-index="0">产品服务</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa  fa-cog"></i>
                    <span class="nav-label">基础资料管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">物流公司列表</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">用户管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="" data-index="0">用户列表</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!--左侧导航结束-->