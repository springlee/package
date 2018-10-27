@extends('layouts.app')
@section('title', __('home'))
@section('content')
    <style type="text/css">
        .sm-st {
            background:#fff;
            padding:20px;
            -webkit-border-radius:3px;
            -moz-border-radius:3px;
            border-radius:3px;
            margin-bottom:20px;
            -webkit-box-shadow: 0 1px 0px rgba(0,0,0,0.05);
            box-shadow: 0 1px 0px rgba(0,0,0,0.05);
        }
        .sm-st-icon {
            width:60px;
            height:60px;
            display:inline-block;
            line-height:60px;
            text-align:center;
            font-size:30px;
            background:#eee;
            -webkit-border-radius:5px;
            -moz-border-radius:5px;
            border-radius:5px;
            float:left;
            margin-right:10px;
            color:#fff;
        }
        .sm-st-info {
            font-size:12px;
            padding-top:2px;
        }
        .sm-st-info span {
            display:block;
            font-size:24px;
            font-weight:600;
        }
        .orange {
            background:#fa8564 !important;
        }
        .tar {
            background:#45cf95 !important;
        }
        .sm-st .green {
            background:#86ba41 !important;
        }
        .pink {
            background:#AC75F0 !important;
        }
        .yellow-b {
            background: #fdd752 !important;
        }
        .stat-elem {

            background-color: #fff;
            padding: 18px;
            border-radius: 40px;

        }

        .stat-info {
            text-align: center;
            background-color:#fff;
            border-radius: 5px;
            margin-top: -5px;
            padding: 8px;
            -webkit-box-shadow: 0 1px 0px rgba(0,0,0,0.05);
            box-shadow: 0 1px 0px rgba(0,0,0,0.05);
            font-style: italic;
        }

        .stat-icon {
            text-align: center;
            margin-bottom: 5px;
        }

        .st-red {
            background-color: #F05050;
        }
        .st-green {
            background-color: #27C24C;
        }
        .st-violet {
            background-color: #7266ba;
        }
        .st-blue {
            background-color: #23b7e5;
        }

        .stats .stat-icon {
            color: #28bb9c;
            display: inline-block;
            font-size: 26px;
            text-align: center;
            vertical-align: middle;
            width: 50px;
            float:left;
        }

        .stat {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            margin-right: 10px; }
        .stat .value {
            font-size: 20px;
            line-height: 24px;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 500; }
        .stat .name {
            overflow: hidden;
            text-overflow: ellipsis; }
        .stat.lg .value {
            font-size: 26px;
            line-height: 28px; }
        .stat.lg .name {
            font-size: 16px; }
        .stat-col .progress {height:2px;}
        .stat-col .progress-bar {line-height:2px;height:2px;}

        .item {
            padding:30px 0;
        }
    </style>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="ibox">
                <div class="ibox-title">
                    <h5><i class="fa fa-dashboard"></i> {{__('Dashboard')}}</h5>
                </div>
                <div class="ibox-content">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="one">

                            <div class="row">
                                <div class="col-sm-3 col-xs-6">
                                    <div class="sm-st clearfix">
                                        <span class="sm-st-icon st-red"><i class="fa fa-users"></i></span>
                                        <div class="sm-st-info">
                                            <span>35200</span>
                                            总会员数                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="sm-st clearfix">
                                        <span class="sm-st-icon st-violet"><i class="fa fa-book"></i></span>
                                        <div class="sm-st-info">
                                            <span>219390</span>
                                            总访问数                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="sm-st clearfix">
                                        <span class="sm-st-icon st-blue"><i class="fa fa-shopping-bag"></i></span>
                                        <div class="sm-st-info">
                                            <span>32143</span>
                                            总订单数                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="sm-st clearfix">
                                        <span class="sm-st-icon st-green"><i class="fa fa-cny"></i></span>
                                        <div class="sm-st-info">
                                            <span>174800</span>
                                            总金额                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card sameheight-item stats">
                                        <div class="card-block">
                                            <div class="row row-sm stats-container">
                                                <div class="col-xs-6 stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-rocket"></i> </div>
                                                    <div class="stat">
                                                        <div class="value"> 430 </div>
                                                        <div class="name"> 今日注册 </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 30%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-shopping-cart"></i> </div>
                                                    <div class="stat">
                                                        <div class="value"> 321 </div>
                                                        <div class="name"> 今日登录 </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 25%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6  stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-line-chart"></i> </div>
                                                    <div class="stat">
                                                        <div class="value"> 2324 </div>
                                                        <div class="name"> 今日订单 </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 25%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6  stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-users"></i> </div>
                                                    <div class="stat">
                                                        <div class="value"> 132 </div>
                                                        <div class="name"> 未处理订单 </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 25%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6  stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                                    <div class="stat">
                                                        <div class="value"> 80% </div>
                                                        <div class="name"> 七日新增 </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 25%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-dollar"></i> </div>
                                                    <div class="stat">
                                                        <div class="value"> 32% </div>
                                                        <div class="name"> 七日活跃 </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 25%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top:15px;">

                                <div class="col-lg-12">
                                </div>
                                <div class="col-xs-6 col-md-3">
                                    <div class="panel bg-blue">
                                        <div class="panel-body">
                                            <div class="panel-title">
                                                <span class="label label-success pull-right">实时</span>
                                                <h5>分类统计</h5>
                                            </div>
                                            <div class="panel-content">
                                                <h1 class="no-margins">1234</h1>
                                                <div class="stat-percent font-bold text-gray"><i class="fa fa-commenting"></i> 1234</div>
                                                <small>当前分类总记录数</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



