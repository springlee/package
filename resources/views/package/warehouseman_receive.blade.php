@extends('layouts.app')
@section('title', '包裹签收')
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>包裹签收</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal autoJqValidator" data-ajax="{{route('package.warehouseman.receive.save', ['package' => $package->id])}}">
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2">物流公司:</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" value="{{$package->logisticsCompany->logistics_company_name}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2">包裹类型:</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" value="{{\App\Models\Package::$typeMap[$package->type]}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2">物流单号:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control" type="text"
                                           value="{{$package->logistics_tracking_number}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2">包裹数量:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control" type="text" value="{{$package->package_quantity}}" readonly >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2">备注:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <textarea class="form-control" name="remark" readonly>{{$package->remark}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2">签收数量:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control" type="text" value="{{$package->package_quantity}}" name="receive_quantity" autofocus="autofocus" required>
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

