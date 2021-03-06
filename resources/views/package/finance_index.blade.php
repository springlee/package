@extends('layouts.app')
@section('title', '包裹签收')
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>包裹对账</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal table-search-form" data-ajax="{{route('package.finance.list')}}">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="created_at" class="control-label col-xs-4 ">{{__('Created at')}}</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control date-range" name="created_at">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label class="control-label col-xs-4 ">物流公司</label>
                                        <div class="col-xs-8">
                                            <select class="form-control select2" name="logistics_company_id">
                                                <option value="">全部</option>
                                                @if($logisticsCompanies)
                                                    @foreach($logisticsCompanies as $key=> $logisticsCompany)
                                                        <option value="{{$logisticsCompany->id}}">{{$logisticsCompany->logistics_company_name}}</option>
                                                    @endforeach
                                                @endif;
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="created_at" class="control-label col-xs-4 ">物流单号</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control" name="logistics_tracking_number">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="created_at" class="control-label col-xs-4 ">状态</label>
                                        <div class="col-xs-8">
                                            <select class="form-control" name="status">
                                                <option value="">全部</option>
                                                @if($statuses)
                                                    @foreach($statuses as $key=> $status)
                                                        <option value="{{$key}}">{{$status}}</option>
                                                    @endforeach
                                                @endif;
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="created_at" class="control-label col-xs-4 ">包裹类型</label>
                                        <div class="col-xs-8">
                                            <select class="form-control" name="type">
                                                <option value="">全部</option>
                                                @if($types)
                                                    @foreach($types as $key=> $type)
                                                        <option value="{{$key}}">{{$type}}</option>
                                                    @endforeach
                                                @endif;
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="receive_user_name" class="control-label col-xs-4 ">签收人</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control" name="receive_user_name">
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="col-xs-12 col-xs-offset-4">
                                            <button class="btn btn-sm btn-info table-search-btn"><i
                                                        class="fa fa-search"></i>{{__('Search')}}
                                            </button>
                                            <button class="btn btn-sm btn-default" type="reset">
                                                {{__('Reset')}}
                                            </button>
                                            <button class="btn btn-sm btn-primary btn-outline   checkbox-all-action" data-ajax="{{route('package.download')}}" data-info="你确定要下载当前包裹信息吗?">
                                                <i class="fa fa-download"></i>下载
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <form target="_blank" method="post">
                            <table id="table"
                                   data-id-field="id"
                                   data-select-item-name="id[]"
                                   data-toolbar="#toolbar"
                                   data-show-refresh="true"
                                   data-show-toggle="true"
                                   data-show-columns="true"
                                   data-cookie="true"
                                   data-cookie-id-table="package"
                                   data-ajax="loadTableData"
                                   data-side-pagination="server"
                                   data-stickyHeader="true"
                                   data-stickyHeaderOffsetY="0"
                                   data-pagination="true"
                                   data-cache="false"
                                   data-page-size="10"
                                   data-sort-order="desc"
                                   data-page-list="[10, 25, 50, 100]">
                                <thead>
                                <tr>
                                    <th data-align="center" data-field="logistics_tracking_number">物流单号</th>
                                    <th data-align="center" data-field="logistics_company_name">物流公司</th>
                                    <th data-align="center" data-field="package_quantity">包裹数量</th>
                                    <th data-align="center" data-field="receive_quantity">签收数量</th>
                                    <th data-align="center" data-field="type_name" data-formatter="typeFormatter">包裹类型</th>
                                    <th data-align="center" data-field="status_name" data-formatter="statusFormatter">{{__('Status')}}</th>
                                    <th data-align="center" data-field="created_at">{{__('Created at')}}</th>
                                    <th data-align="center" data-field="received_at">签收时间</th>
                                    <th data-align="center" data-field="receive_user_name">签收人</th>
                                    <th data-align="center" data-field="mark_sure_name" data-formatter="markSureFormatter" >确认状态</th>
                                    <th data-align="center" data-formatter="logisticsFormatter">物流轨迹</th>
                                    <th data-align="center" data-field="operate" data-formatter="operateFormatter">{{__('Operate')}}</th>
                                    <th data-align="center" data-field="remark">备注</th>
                                </tr>
                                </thead>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function logisticsFormatter(value, row, index) {
          return '<span data-id="' + row.id + '" class="btn btn-xs btn-primary btn-logistics-one" ><i class="fa fa-eye"></i></span>';
        }
        function markSureFormatter(value, row, index){
            if (typeof value === 'undefined') {
                return '';
            } else {
                var color = typeof tableOperate.mark_sure[row.mark_sure] !== 'undefined' ? tableOperate.mark_sure[row.mark_sure] : 'primary';
                return '<span id="mark_sure-' + row.id + '"  data-mark_sure="' + row.mark_sure + '" class="mark_sure text-' + color + '"><i class="fa fa-circle"></i>' + value + '</span>';
            }
        }
        tableOperate = {
            type:{'normal':'info','urgent':'success','immediately':'danger'},
            status:{'new':'info','finish':'success'},
            mark_sure:{'new':'primary','correct':'success','error':'danger'},
            extend: {
                buttons: [
                    {
                        name: '正确',
                        icon: 'fa fa-check',
                        title: '正确',
                        msg:'确定标记包裹正确?',
                        class_name: 'btn btn-xs btn-info  btn-operate-one',
                        url:'{{route('package.finance.make_sure')}}'
                    },
                    {
                        name: '错误',
                        icon: 'fa fa-close',
                        title: '错误',
                        msg:'确定标记包裹错误?',
                        class_name: 'btn btn-xs btn-danger  btn-operate-one',
                        url:'{{route('package.finance.un_make_sure')}}'
                    }
                ]
            }
        };
        $(function () {
            $(document).on('click','.btn-logistics-one',function () {
                var url ='{{route('package.logistics')}}'+'/'+$(this).data('id');
                $.getJSON(url,function (data) {
                    layer.open({
                        type: 2,
                        title: '物流轨迹',
                        shadeClose: true,
                        shade: 0.5,
                        area: ['540px', '340px'],
                        content: data.url
                    });
                })
            });
            $('#table').on('load-success.bs.table', function (data) {
                $('#table tr').each(function (index, value) {
                    if(index>0){
                        var status = $(value).find('span.status').data('status');
                        if(status==='new'){
                            $(value).find('a.btn-operate-one').hide();
                        }
                        var mark_sure = $(value).find('span.mark_sure').data('mark_sure');
                        if(mark_sure!=='new'){
                            $(value).find('a.btn-operate-one').hide();
                        }
                    }
                })
            });
        })
    </script>
@endsection

