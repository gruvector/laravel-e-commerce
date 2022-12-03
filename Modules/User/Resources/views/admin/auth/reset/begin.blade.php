@extends('user::admin.auth.layout')

@section('title', trans('user::auth.reset_password'))

@section('content')
    <div class="login-wrapper">
        <div class="bg-blue">
            <div class="reflection"></div>
        </div>

        <div class="form-inner reset-password clearfix">
            <h3 class="text-center">{{ trans('user::auth.reset_password') }}</h3>
            <p class="text-center">{{ trans('user::auth.enter_email') }}</p>

            <form method="POST" action="{{ route('admin.reset.post') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="{{ trans('user::attributes.users.email') }}" autofocus>

                    <div class="input-icon">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>

                    {!! $errors->first('email', '<span class="help-block text-red">:message</span>') !!}
                </div>

                <button type="submit" class="btn btn-primary" data-loading>
                    {{ trans('user::auth.reset_password') }}
                </button>
            </form>

            <a class="text-center" href="{{ route('admin.login') }}">{{ trans('user::auth.i_remembered_my_password') }}</a>
        </div>
    </div>
@endsection
