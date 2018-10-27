@extends('layouts.app')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>{{ __('Register') }}</h2>
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
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group ">
                            <input placeholder="{{ __('Company Name') }}" type="text"
                                   class="form-control{{ $errors->has('enterprise_company_name') ? ' is-invalid' : '' }}"
                                   name="enterprise_company_name" value="{{ old('enterprise_company_name') }}" required autofocus>
                            @if ($errors->has('enterprise_company_name'))
                                  <span class="has-error text-left" role="alert">
                                      <strong class="help-block">{{ $errors->first('enterprise_company_name') }}</strong>
                                  </span>
                            @endif
                        </div>
                        <div class="form-group ">
                            <input placeholder="{{ __('E-Mail Address') }}" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="has-error text-left" role="alert">
                                        <strong class="help-block">{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group ">
                            <input placeholder="{{ __('Password') }}" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>
                            @if ($errors->has('password'))
                                <span class="has-error text-left" role="alert">
                                        <strong class="help-block">{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group ">
                            <input placeholder="{{ __('Confirm Password') }}" type="password"
                                   class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
