@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('user::users.user')]))

    <li><a href="{{ route('admin.users.index') }}">{{ trans('user::users.users') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('user::users.user')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.users.store') }}" class="form-horizontal" id="user-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('user')) !!}
    </form>
@endsection

@include('user::admin.users.partials.shortcuts')
