
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>登录</title>
    <link href="{{load('/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/animate.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/style.min.css')}}" rel="stylesheet">
    <link href="{{load('/css/lib/login.min.css')}}" rel="stylesheet">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>
</head>
<style>
    .nav>li>a:focus, .nav>li>a:hover{
        background-color:inherit ;
    }
    .nav .open>a, .nav .open>a:focus, .nav .open>a:hover{
        background-color:inherit ;
    }
    .dropdown-menu>li>a {
        color: #999c9e;
    }
</style>
<body class="signin">
<div class="row ">
    <div class="col-sm-10 text-right" style="margin-top: 50px">
        <ul class="nav navbar-nav navbar-right">
            <!-- Localization -->
            <li class="">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="language">{{__('Language')}}</span> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li data-language="en">
                        <a href="{{ url('/changeLocale/en') }}">English</a>
                    </li>
                    <li data-language="zh-cn">
                        <a href="{{ url('/changeLocale/zh-CN') }}">简体中文</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <div class="logopanel m-b">
                    <h1>[ PARCEL ]</h1>
                </div>
                <div class="m-b"></div>
                <h4>{{ __('Welcome to use parcel monitoring system.') }}</h4>
                <ul class="m-b">
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势一</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势二</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势三</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势四</li>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势五</li>
                </ul>
                <strong>{{ __('Have No Account?') }} <a href="{{ route('register') }}">{{ __('Register') }}&raquo;</a></strong>
            </div>
        </div>
        <div class="col-sm-5">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h4 class="no-margins">{{ __('Login') }}：</h4>
                <input type="text" class="form-control uname" name="email"  placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}"/>
                @if ($errors->has('email'))
                    <span class="has-error" role="alert"><strong class="help-block">{{ $errors->first('email') }}</strong></span>
                @endif
                <input type="password" class="form-control pword m-b" placeholder="{{ __('Password') }}" name="password"/>
                @if ($errors->has('password'))
                    <span class=has-error" role="alert"><strong class="help-block">{{ $errors->first('password') }}</strong></span>
                @endif
                <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                <button class="btn btn-success btn-block">{{ __('Login') }}</button>
            </form>
        </div>
    </div>

    <div class="signup-footer">
        <div class="pull-left">
            &copy; 2018 All Rights Reserved. PARCEL
        </div>
    </div>
</div>
<script src="{{load('/js/lib/jquery.min.js')}}"></script>
<script src="{{load('/js/lib/bootstrap.min.js')}}"></script>
</body>
</html>