@extends('layouts.app')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>{{ __('Reset Password') }}</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="middle-box text-center animated fadeInRight">
                    <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group row">
                            <input placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="has-error text-left" role="alert"><strong class="help-block">{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <input placeholder="{{ __('Password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="has-error text-left" role="alert"><strong class="help-block">{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <input placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
