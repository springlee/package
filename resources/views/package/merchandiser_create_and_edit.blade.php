@extends('layouts.app')
@section('title', __('Package'))
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>包裹{{!$package->id ? __('Create'): __('Edit')}}</h5>
                    </div>
                    <div class="ibox-content">
                        @if($package->id)
                            <form class="form-horizontal autoJqValidator"
                                  data-ajax="{{route('package.merchandiser.update', ['package' => $package->id])}}">
                                @else
                                    <form class="form-horizontal autoJqValidator"
                                          data-ajax="{{route('package.merchandiser.store')}}">
                                        @endif
                                        <div class="form-group">
                                            <label  class="control-label col-xs-12 col-sm-2">物流公司:</label>
                                            <div class="col-xs-8">
                                                <select class="form-control" name="logistics_company_id" required>
                                                    <option value="">请选择</option>
                                                    @if($logisticsCompanies)
                                                        @foreach($logisticsCompanies as $key=> $logisticsCompany)
                                                            <option value="{{$logisticsCompany->id}}" {{$package->logistics_company_id==$logisticsCompany->id?'selected':''}}>{{$logisticsCompany->logistics_company_name}}</option>
                                                        @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-2">包裹类型:</label>
                                            <div class="col-xs-8">
                                                <select class="form-control" name="type" required>
                                                    @if($types)
                                                        @foreach($types as $key=> $type)
                                                            <option value="{{$key}}" {{$key==$package->type?'selected':''}}>{{$type}}</option>
                                                        @endforeach
                                                    @endif;
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-2">物流单号:</label>
                                            <div class="col-xs-12 col-sm-8">
                                                <input  class="form-control"
                                                       name="logistics_tracking_number" type="text"
                                                       value="{{$package->logistics_tracking_number}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-2">包裹数量:</label>
                                            <div class="col-xs-12 col-sm-8">
                                                <input  class="form-control"
                                                       name="package_quantity" type="text"
                                                       value="{{$package->package_quantity}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-2">备注:</label>
                                            <div class="col-xs-12 col-sm-8">
                                               <textarea class="form-control" name="remark">{{$package->remark}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group layer-footer">
                                            <label class="control-label col-xs-12 col-sm-2"></label>
                                            <div class="col-xs-12 col-sm-8">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success">{{__('Submit')}}</button>
                                                <button type="reset"
                                                        class="btn btn-sm btn-default">{{__('Reset')}}</button>
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

