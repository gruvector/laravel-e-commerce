@extends('admin::layout')

@section('title', trans('admin::resource.edit', ['resource' => trans('user::users.profile')]))

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('user::users.profile')]))

    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('user::users.profile')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.profile.update') }}" class="form-horizontal" id="profile-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render() !!}
    </form>
@endsection
