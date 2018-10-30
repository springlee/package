<!--右侧部分开始-->
<style>
    .roll-right.J_tabRight {
        right: 160px
    }

    .roll-right.screen{
        right: 40px;
    }
    .roll-right.btn-group {
        right: 80px;
        width: 80px;
        padding: 0
    }
</style>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li class="m-t-xs">
                            <div class="dropdown-messages-box">
                                <div class="media-body">
                                    <small class="pull-right">46小时前</small>
                                    <strong>小四</strong> 这个在日本投降书上签字的军官，建国后一定是个不小的干部吧？
                                    <br>
                                    <small class="text-muted">3天前 2014.11.8</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <div class="media-body ">
                                    <small class="pull-right text-navy">25小时前</small>
                                    <strong>国民岳父</strong> 如何看待“男子不满自己爱犬被称为狗，刺伤路人”？——这人比犬还凶
                                    <br>
                                    <small class="text-muted">昨天</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a class="J_menuItem" href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong> {{__('View all messages')}}</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown hidden-xs">
                    <a class="right-sidebar-toggle" aria-expanded="false">
                        <i class="fa fa-tasks"></i> {{__('Theme')}}
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row content-tabs">
        <button class="navbar-minimalize roll-nav toggle" href="#"><i class="fa fa-bars"></i></button>
        <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i></button>
        <nav class="page-tabs J_menuTabs">
            <div class="page-tabs-content">
                <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">{{__('Home')}}</a>
            </div>
        </nav>
        <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i></button>
        <div class="btn-group roll-nav roll-right">
            <button class="dropdown J_tabClose" data-toggle="dropdown">{{__('Closing')}}<span class="caret"></span></button>
            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                <li class="J_tabShowActive"><a>{{__('Closing')}}</a></li>
                <li class="divider"></li>
                <li class="J_tabCloseAll"><a>{{__('Close all tabs')}}</a>
                </li>
                <li class="J_tabCloseOther"><a>{{__('Close other tabs')}}</a>
                </li>
            </ul>
        </div>
        <button class="roll-nav roll-right screen" id="screen"><i class="fa fa-arrows-alt"></i></button>
        <button class="roll-nav roll-right refresh" id="refresh"><i class="fa fa-refresh"></i></button>
    </div>
    <div class="row J_mainContent" id="content-main">
        <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{route('index.main')}} "
                frameborder="0" data-id="index_v1.html"></iframe>
    </div>
</div>
<!--右侧部分结束-->
<!--右侧边栏开始-->
<div id="right-sidebar">
    <div class="sidebar-container">
        <ul class="nav nav-tabs navs-3">
            <li class="active">
                <a data-toggle="tab" href="#tab-1">
                    <i class="fa fa-gear"></i>  {{__('Theme')}}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="sidebar-title">
                    <h3><i class="fa fa-comments-o"></i>{{__('Theme')}}{{__('Setting')}}</h3>
                    <small><i class="fa fa-tim"></i>{{__('You can select and preview the layout and style of the theme from here, and these settings are saved locally and applied directly the next time you open them.')}}</small>
                </div>
                <div class="skin-setttings">
                    <div class="title">{{__('Theme')}}{{__('Setting')}}</div>
                    <div class="setings-item">
                        <span>{{__('Pick up the left menu')}}</span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                       id="collapsemenu">
                                <label class="onoffswitch-label" for="collapsemenu">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>{{__('Fixed top')}}</span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                <label class="onoffswitch-label" for="fixednavbar">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setings-item">
                        <span>{{__('Fixed width')}}</span>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                <label class="onoffswitch-label" for="boxedlayout">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--右侧边栏结束-->