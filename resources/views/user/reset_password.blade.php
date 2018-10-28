@extends('layouts.app')
@section('title',  __('Reset Password'))
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{__('Reset Password')}}</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal autoJqValidator" data-ajax="{{route('_users.password.update')}}">
                            <div class="form-group">
                                <label for="password" class="control-label col-xs-12 col-sm-2">{{ __('Password') }}:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="password" class="form-control" type="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="control-label col-xs-12 col-sm-2">{{ __('Confirm Password') }}:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="confirm_password" class="form-control" type="password" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group layer-footer">
                                <label class="control-label col-xs-12 col-sm-2"></label>
                                <div class="col-xs-12 col-sm-8">
                                    <button type="submit" class="btn btn-sm btn-success">{{ __('Confirm') }}</button>
                                    <button type="reset" class="btn btn-sm btn-default">{{ __('Reset') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function () {
            $(".autoJqValidator").validate({
                ignore: '',
            })
        })

    </script>
@endsection
