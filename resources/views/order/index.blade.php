@extends('layouts.app')
@section('title', __('Logistics Companies'))
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>服务费用列表</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal table-search-form" data-ajax="{{route('orders.list')}}">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="created_at" class="control-label col-xs-4 ">{{__('Created at')}}</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control date-range" name="created_at">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="logistics_company_name" class="control-label col-xs-4">交易号</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control" name="transaction_id">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="logistics_company_name" class="control-label col-xs-4">系统单号</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control" name="order_sn">
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
                            <table id="table"
                                   data-id-field="id"
                                   data-select-item-name="id[]"
                                   data-toolbar="#toolbar"
                                   data-show-refresh="true"
                                   data-show-toggle="true"
                                   data-show-columns="true"
                                   data-cookie="true"
                                   data-cookie-id-table="order"
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
                                    <th data-align="center" data-field="order_sn">系统单号</th>
                                    <th data-align="center" data-field="transaction_id">交易号</th>
                                    <th data-align="center" data-field="product_info">产品服务信息</th>
                                    <th data-align="center" data-field="money">金额(元)</th>
                                    <th data-align="center" data-field="remark">备注</th>
                                    <th data-align="center" data-field="created_at">{{__('Created at')}}</th>
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
        tableOperate = {
            edit_url: '{{route('logistics_companies.edit')}}',
            active_url: '{{route('logistics_companies.active')}}',
            extend: {
                buttons: []
            }
        }
    </script>
@endsection

