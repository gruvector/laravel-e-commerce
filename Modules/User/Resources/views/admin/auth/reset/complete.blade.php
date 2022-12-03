@extends('user::admin.auth.layout')

@section('title', trans('user::auth.reset_password'))

@section('content')
    <div class="login-wrapper">
        <div class="bg-blue">
            <div class="reflection"></div>
        </div>

        <div class="form-inner reset-password clearfix">
            <h3 class="text-center">{{ trans('user::auth.reset_password') }}</h3>

            <form method="POST" class="login-form clearfix">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="password" class="form-control" name="new_password" placeholder="{{ trans('user::attributes.users.new_password') }}" autofocus>

                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                    </div>

                    {!! $errors->first('new_password', '<span class="help-block text-red">:message</span>') !!}
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="new_password_confirmation" placeholder="{{ trans('user::attributes.users.confirm_new_password') }}">

                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                    </div>

                    {!! $errors->first('new_password_confirmation', '<span class="help-block text-red">:message</span>') !!}
                </div>

                <button class="btn btn-primary" type="submit" data-loading>
                    {{ trans('user::auth.reset_password') }}
                </button>
            </form>
        </div>
    </div>
@endsection
