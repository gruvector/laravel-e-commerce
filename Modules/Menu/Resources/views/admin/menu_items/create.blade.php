@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('menu::menu_items.menu_item')]))

    <li><a href="{{ route('admin.menus.index') }}">{{ trans('menu::menus.menus') }}</a></li>
    <li><a href="{{ route('admin.menus.edit', $menuId) }}">{{ trans('admin::resource.edit', ['resource' => trans('menu::menus.menu')]) }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('menu::menu_items.menu_item')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.menus.items.store', $menuId) }}" class="form-horizontal" id="menu-item-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('menuId', 'menuItem')) !!}
    </form>
@endsection

@include('menu::admin.menu_items.partials.shortcuts')
