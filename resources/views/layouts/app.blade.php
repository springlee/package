<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="toTop" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', ''))</title>
    <meta name="keywords" content="{{ config('app.name', '') }}">
    <meta name="description" content="{{ config('app.name', '') }}">
    <link href="{{load('/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/animate.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/custom.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/select2.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/select2-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/bootstrap-table.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/toastr.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/daterangepicker.css')}}" rel="stylesheet">
    {{--<link href="{{load('/css/lib/admin.css')}}" rel="stylesheet">--}}
    <link href="{{load('/css/lib/style.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/switchery.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body class="gray-bg {{ route_class() }}-page" id="app">
@yield('content')

<script>
    var _locale = '{{$locale}}';
</script>
<script src="{{load('/js/lib/jquery.min.js')}}"></script>
<script src="{{load('/js/lib/bootstrap.min.js')}}"></script>
<script src="{{load('/js/lib/layer.js')}}"></script>
<script src="{{load('/js/lib/toastr.min.js')}}"></script>

<!--表单验证-->
<script src="{{load('/js/lib/jquery.validate.min.js')}}"></script>
<script src="{{load('/js/lib/jquery.form.js')}}"></script>
<script src="{{load('/js/lib/icheck.min.js')}}"></script>
<script src="{{load('/js/lib/select2.min.js')}}"></script>
<!-- 表格 -->
<script src="{{load('/js/lib/bootstrap-table.min.js')}}"></script>

<script src="{{load('/js/lib/bootstrap-table-cookie.js')}}"></script>
<script src="{{load('/js/lib/bootstrap-table-sticky-header.js')}}"></script>
<script src="{{load('/js/lib/locale-'.$locale.'.js')}}"></script>
<!--时间控件-->
<script src="{{load('/js/lib/moment.min.js')}}"></script>
<script src="{{load('/js/lib/daterangepicker.js')}}"></script>
<script src="{{load('/js/lib/laydate.js')}}"></script>
<!--上传控件-->
<script src="{{load('/js/lib/bootstrap-prettyfile.js')}}"></script>

<script src="{{load('/js/lib/switchery.js')}}"></script>

<script src="{{load('/js/lib/main.js')}}"></script>

@if($locale==="zh-CN")
    <script src="{{load('/js/lib/messages_zh.min.js')}}"></script>
    <script src="{{load('/js/lib/bootstrap-table-zh-CN.min.js')}}"></script>
@endif
@yield('js')
</body>
</html>
