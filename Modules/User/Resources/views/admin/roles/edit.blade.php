@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('user::roles.role')]))
    @slot('subtitle', $role->name)

    <li><a href="{{ route('admin.roles.index') }}">{{ trans('user::roles.roles') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('user::roles.role')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="form-horizontal" id="role-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('role')) !!}
    </form>
@endsection

@include('user::admin.roles.partials.shortcuts')
