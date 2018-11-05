@extends('layouts.app')
@section('content')
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>{{ __('Forbidden') }}</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="middle-box text-center animated fadeInRight">
                    <div class="alert alert-danger" role="alert">
                        你的系统服务时间已到期，请充值~
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
