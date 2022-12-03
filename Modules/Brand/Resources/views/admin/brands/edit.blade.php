@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('brand::brands.brand')]))
    @slot('subtitle', $brand->name)

    <li><a href="{{ route('admin.brands.index') }}">{{ trans('brand::brands.brands') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('brand::brands.brand')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.brands.update', $brand) }}" class="form-horizontal" id="brand-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('brand')) !!}
    </form>
@endsection

@include('brand::admin.brands.partials.shortcuts')
