@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('brand::brands.brand')]))

    <li><a href="{{ route('admin.brands.index') }}">{{ trans('brand::brands.brands') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('brand::brands.brand')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.brands.store') }}" class="form-horizontal" id="brand-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('brand')) !!}
    </form>
@endsection

@include('brand::admin.brands.partials.shortcuts')
