@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('flashsale::flash_sales.flash_sale')]))

    <li><a href="{{ route('admin.flash_sales.index') }}">{{ trans('flashsale::flash_sales.flash_sales') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('flashsale::flash_sales.flash_sale')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.flash_sales.store') }}" class="form-horizontal" id="flash-sale-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('flashSale')) !!}
    </form>
@endsection

@include('flashsale::admin.flash_sales.partials.shortcuts')
