@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>{{ __('Verify Your Email Address') }}</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="middle-box text-center animated fadeInRight">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <div class="error-desc"  style="font-size: 16px">
                        {{ __('Before proceeding, please check your email for a verification link.') }} <br>
                        {{ __('If you did not receive the email') }}<br>
                        <a href="{{ route('verification.resend') }}" class="btn btn-primary m-t">{{ __('click here to request another') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
