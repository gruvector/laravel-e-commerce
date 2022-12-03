@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('menu::menus.menu')]))

    <li><a href="{{ route('admin.menus.index') }}">{{ trans('menu::menus.menus') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('menu::menus.menu')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.menus.store') }}" class="form-horizontal" id="menu-create-form" novalidate>
        {{ csrf_field() }}

        @include('menu::admin.menus.form.fields')
    </form>
@endsection

@include('menu::admin.menus.partials.shortcuts')
