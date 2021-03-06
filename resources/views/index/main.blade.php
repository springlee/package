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

        @foreach($products as $product)
            @if(\Carbon\Carbon::now()->diffInDays(new \Carbon\Carbon($product->pivot->expiry_date),false)<30)
                <div class="alert alert-warning alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    @if(\Carbon\Carbon::now()->diffInDays(new \Carbon\Carbon($product->pivot->expiry_date),false)<0)
                        "{{$product->product_name}}" 已到期 ,请尽快充值
                          @else
                        "{{$product->product_name}}" 即将到期 剩余天数（{{\Carbon\Carbon::now()->diffInDays(new \Carbon\Carbon($product->pivot->expiry_date),false)}}）天, 请尽快充值
                    @endif

                </div>
            @endif
        @endforeach
        <div class="row">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>{{ Auth::user()->enterpriseCompany->enterprise_company_name}}</h5>
                    <div class="ibox-tools">
                        <div>系统服务到期时间:<span class="text-danger"> {{Auth::user()->expiry_date}}</span></div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="one">

                            <div class="row">
                                <div class="col-sm-3 col-xs-6">
                                    <div class="sm-st clearfix">
                                        <span class="sm-st-icon st-red"><i class="fa fa-users"></i></span>
                                        <div class="sm-st-info">
                                            <span>{{$data['user_count']}}</span>企业用户数</div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="sm-st clearfix">
                                        <span class="sm-st-icon st-violet"><i class="fa fa-book"></i></span>
                                        <div class="sm-st-info">
                                            <span>{{$data['package_total_count']}}</span>总包裹数量</div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="sm-st clearfix">
                                        <span class="sm-st-icon st-blue"><i class="fa fa-shopping-bag"></i></span>
                                        <div class="sm-st-info">
                                            <span>{{$data['package_total_urgent_count']}}</span>紧急件</div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="sm-st clearfix">
                                        <span class="sm-st-icon st-green"><i class="fa fa-cny"></i></span>
                                        <div class="sm-st-info">
                                            <span>{{$data['package_total_immediately_count']}}</span>立即处理件</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <p>今日包裹</p>
                                <div class="">
                                    <div class="card sameheight-item stats">
                                        <div class="card-block">
                                            <div class="row row-sm stats-container">
                                                <div class="col-xs-6 stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-rocket"></i> </div>
                                                    <div class="stat">
                                                        <div class="value">{{$data['package_today_count']}}</div>
                                                        <div class="name">包裹量</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 80%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-shopping-cart"></i> </div>
                                                    <div class="stat">
                                                        <div class="value">{{$data['package_today_urgent_count']}}</div>
                                                        <div class="name">紧急件</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 80%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6  stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-line-chart"></i> </div>
                                                    <div class="stat">
                                                        <div class="value">{{$data['package_today_immediately_count']}}</div>
                                                        <div class="name">立即处理件</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 80%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6  stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-users"></i> </div>
                                                    <div class="stat">
                                                        <div class="value">{{$data['package_today_un_deal_count']}}</div>
                                                        <div class="name">未签收件</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 80%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6  stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                                                    <div class="stat">
                                                        <div class="value">{{$data['package_today_un_deal_urgent_count']}}</div>
                                                        <div class="name">未签收紧急件</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 80%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 stat-col">
                                                    <div class="stat-icon"> <i class="fa fa-dollar"></i> </div>
                                                    <div class="stat">
                                                        <div class="value">{{$data['package_today_un_deal_immediately_count']}}</div>
                                                        <div class="name">未签收立即处理件</div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" style="width: 80%"></div>
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
        </div>
    </div>
@stop



