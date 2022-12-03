@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('flashsale::flash_sales.flash_sale')]))
    @slot('subtitle', $flashSale->campaign_name)

    <li><a href="{{ route('admin.flash_sales.index') }}">{{ trans('flashsale::flash_sales.flash_sales') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('flashsale::flash_sales.flash_sale')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.flash_sales.update', $flashSale) }}" class="form-horizontal" id="flash-sale-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('flashSale')) !!}
    </form>
@endsection

@include('flashsale::admin.flash_sales.partials.shortcuts')
