@extends('layouts.app')
@section('title', __('Logistics Companies'))
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{__('Logistics Companies')}}</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal table-search-form" data-ajax="{{route('logistics_companies.list')}}">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="created_at" class="control-label col-xs-4 ">{{__('Created at')}}</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control date-range" name="created_at">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="logistics_company_name" class="control-label col-xs-4">{{__('Logistics Company')}}</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control" name="logistics_company_name">
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
                                <a class="btn btn-sm btn-success btn-add-one" href="{{route('logistics_companies.create')}}"
                                   title="{{__('Create')}}">
                                    <i class="fa fa-plus"></i>{{__('Create')}}
                                </a>
                            </div>
                            <table id="table"
                                   data-id-field="id"
                                   data-select-item-name="id[]"
                                   data-toolbar="#toolbar"
                                   data-show-refresh="true"
                                   data-show-toggle="true"
                                   data-show-columns="true"
                                   data-cookie="true"
                                   data-cookie-id-table="logistics_company"
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
                                    <th data-align="center" data-field="logistics_company_name">{{__('Logistics Company')}}</th>
                                    <th data-align="center" data-field="created_at">{{__('Created at')}}</th>
                                    <th data-align="center" data-field="status" data-formatter="activeFormatter">{{__('Status')}}</th>
                                    <th data-align="center" data-field="operate" data-formatter="operateFormatter">{{__('Operate')}}</th>
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

