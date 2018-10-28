@extends('layouts.app')
@section('title', __('Users'))
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{__('User')}}{{!$user->id ? __('Create'): __('Edit')}}</h5>
                    </div>
                    <div class="ibox-content">
                         @if($user->id)
                            <form class="form-horizontal autoJqValidator" data-ajax="{{route('_users.update', ['user' => $user->id])}}">
                                @else
                               <form  class="form-horizontal autoJqValidator" data-ajax="{{route('_users.store')}}">
                         @endif
                               <div class="form-group">
                                    <label for="name" class="control-label col-xs-12 col-sm-2">{{__('Name')}}:</label>
                                    <div class="col-xs-12 col-sm-8">
                                        <input id="name" class="form-control" name="name" type="text" value="{{$user->name}}" required>
                                    </div>
                                </div>
                                   <div class="form-group">
                                       <label for="email" class="control-label col-xs-12 col-sm-2">{{__('Email')}}:</label>
                                       <div class="col-xs-12 col-sm-8">
                                           <input id="email" class="form-control" name="email" type="text" value="{{$user->email}}" required>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="password" class="control-label col-xs-12 col-sm-2">{{__('Password')}}:</label>
                                       <div class="col-xs-12 col-sm-8">
                                           <input id="password" class="form-control" name="password" type="password" value="{{$user->id?'3ArAiVfZ':''}}" required>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="password_confirmation" class="control-label col-xs-12 col-sm-2">{{ __('Confirm Password') }}:</label>
                                       <div class="col-xs-12 col-sm-8">
                                           <input id="password_confirmation" class="form-control" name="password_confirmation" type="password" value="{{$user->id?'3ArAiVfZ':''}}" required>
                                       </div>
                                   </div>
                            <div class="form-group layer-footer">
                                <label class="control-label col-xs-12 col-sm-2"></label>
                                <div class="col-xs-12 col-sm-8">
                                    <button type="submit" class="btn btn-sm btn-success">{{__('Submit')}}</button>
                                    <button type="reset" class="btn btn-sm btn-default">{{__('Reset')}}</button>
                                </div>
                            </div>
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
            $(".autoJqValidator").validate({
                ignore: '',
            })
        })

    </script>
@endsection

