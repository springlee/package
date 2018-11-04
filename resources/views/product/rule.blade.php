@extends('layouts.app')
@section('title', '我的产品')
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>产品明细</h5>
                    </div>
                    <div class="ibox-content">
                        <form  class="form-horizontal autoJqValidator" data-ajax="{{route('products.pay',$product->id)}}">
                            <input type="hidden" name="rule_id" id="rule_id">
                            <h3>{{$product->product_name}}</h3>
                            <blockquote class="text-warning" style="font-size:14px">
                                {{$product->product_desc}}
                            </blockquote>
                            <div class="row">
                                <div class="col-xs-6 ">
                                    @foreach($product->rules as $key=>$rule)
                                        <button type="button" class=" col-xs-2 col-sm-2 col-md-2 col-lg-2 price_select btn btn-outline btn-success" style="margin: 5px"
                                                data-price="{{round($rule->price)}}"
                                                data-rule_id="{{round($rule->id)}}"
                                        >{{$rule->num}}{{\App\Models\Product::$unitMap[$product->unit]}}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            <div style="margin:10px 0">订单金额: <span class="text-danger price" style="font-size: 20px;" >0</span> 元</div>
                            <button type="submit" class="btn-success btn"><i class="fa fa-dollar"></i>支付</button>
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
            $(window).on('load',function () {
                $(".price_select").eq(0).trigger('click');
            });
            $(".price_select").on('click',function () {
                $(this).addClass('active').siblings().removeClass('active');
                $(".price").html( $(this).data('price'));
                $("#rule_id").val( $(this).data('rule_id'));
            })
        })
    </script>
@endsection

