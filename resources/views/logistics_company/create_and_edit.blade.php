@extends('layouts.app')
@section('title', __('Logistics Company'))
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{__('Logistics Company')}}{{!$logisticsCompany->id ? __('Create'): __('Edit')}}</h5>
                        <div class="ibox-tools">
                            <a  href="{{url('/')}}/data/快递公司和快递编码对照表.xlsx">
                                <i class="fa fa-download"> 常用物流编码参照下载</i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="alert alert-danger">
                           物流编码需填写正确不然无法获取物流轨迹！！！
                        </div>

                         @if($logisticsCompany->id)
                            <form class="form-horizontal autoJqValidator" data-ajax="{{route('logistics_companies.update', ['logisticsCompany' => $logisticsCompany->id])}}">
                                @else
                               <form  class="form-horizontal autoJqValidator" data-ajax="{{route('logistics_companies.store')}}">
                         @endif
                            <div class="form-group">
                                <label for="logistics_company_name" class="control-label col-xs-12 col-sm-2">{{__('Logistics Company')}}:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="logistics_company_name" class="form-control" name="logistics_company_name" type="text" value="{{$logisticsCompany->logistics_company_name}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="logistics_company_name" class="control-label col-xs-12 col-sm-2">{{__('Logistics Company Code')}}:</label>
                                  <div class="col-xs-12 col-sm-8">
                                         <input id="logistics_company_name" class="form-control" name="logistics_company_code" type="text" value="{{$logisticsCompany->logistics_company_code}}" required>
                                   </div>
                           </div>
                            <div class="form-group layer-footer">
                                <label class="control-label col-xs-12 col-sm-2"></label>
                                <div class="col-xs-12 col-sm-8">
                                    <button type="submit" class="btn btn-sm btn-success">{{__('Submit')}}</button>
                                    <button type="reset" class="btn btn-sm btn-default">{{__('Reset')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $(".autoJqValidator").validate({
                ignore: '',
            })
        })

    </script>
@endsection

