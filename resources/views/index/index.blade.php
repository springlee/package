<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>@yield('title', config('app.name'))</title>
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{load('/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/animate.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/style.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/toastr.min.css')}}" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    @include('layouts._left')
    @include('layouts._right')
</div>
<script src="{{load('/js/lib/jquery.min.js')}}"></script>
<script src="{{load('/js/lib/bootstrap.min.js')}}"></script>
<script src="{{load('/js/lib/jquery.metisMenu.js')}}"></script>
<script src="{{load('/js/lib/jquery.slimscroll.min.js')}}"></script>
<script src="{{load('/js/lib/layer.js')}}"></script>
<script src="{{load('/js/lib/hplus.min.js')}}"></script>
<script src="{{load('/js/lib/contabs.min.js')}}"></script>
<script src="{{load('/js/lib/pace.min.js')}}"></script>
<script src="{{load('/js/lib/toastr.min.js')}}"></script>
<script src="{{load('/js/lib/top.js')}}"></script>
</body>
</html>