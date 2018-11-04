@extends('layouts.app')
@section('title', '我的产品')
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>我的产品</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>产品名称</th>
                                <th>描述</th>
                                <th>到期日期</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key=>$product )
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_desc}}</td>
                                @if(in_array($product->id,array_keys($enterpriseCompanyProducts)))
                                    <td>{{$enterpriseCompanyProducts[$product->id]['pivot']['expiry_date']}}</td>
                                    <td><a  class="btn btn-sm btn-danger" href="{{route('products.rules',$product->id)}}"><i class="fa fa-dollar"></i>续费</a></td>
                                    @else
                                    <td>-</td>
                                    <td><a  class="btn btn-sm btn-success" href="{{route('products.rules',$product->id)}}"><i class="fa fa-dollar"></i>充值</a></td>
                                @endif

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

