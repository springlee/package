@extends('layouts.app')
@section('title', __('Packages'))
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{__('Packages')}}</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal table-search-form" data-ajax="{{route('package.merchandiser.list')}}">
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
                                            <select class="form-control" name="logistics_company_id">
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
                                            <input type="text" class="form-control date-range" name="logistics_tracking_number">
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
                                        <div class="col-sm-8 col-xs-offset-4">
                                            <button class="btn btn-sm btn-info table-search-btn"><i
                                                        class="fa fa-search"></i>{{__('Search')}}
                                            </button>
                                            <button class="btn btn-sm btn-default" type="reset">
                                                {{__('Reset')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <form target="_blank" method="post">
                            <div id="toolbar">
                                <a class="btn btn-sm btn-success btn-add-one" href="{{route('package.merchandiser.create')}}"
                                   title="{{__('Create')}}">
                                    <i class="fa fa-plus"></i>{{__('Create')}}
                                </a>
                            </div>
                            <table id="table"
                                   data-toggle="table"
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
                                    <th data-align="center" data-field="type_name" data-formatter="typeFormatter">包裹类型</th>
                                    <th data-align="center" data-field="status_name" data-formatter="statusFormatter">{{__('Status')}}</th>
                                    <th data-align="center" data-field="created_at">{{__('Created at')}}</th>
                                    <th data-align="center" data-field="type" data-formatter="logisticsFormatter">物流轨迹</th>
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

        tableOperate = {
            edit_url: '{{route('package.merchandiser.edit')}}',
            type:{'normal':'info','urgent':'success','immediately':'danger'},
            status:{'new':'info','finish':'success'},
            extend: {
                buttons: []
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
            })
        })
    </script>
@endsection

