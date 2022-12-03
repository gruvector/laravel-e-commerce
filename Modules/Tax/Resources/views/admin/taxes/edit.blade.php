@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('tax::taxes.tax')]))
    @slot('subtitle', $taxClass->title)

    <li><a href="{{ route('admin.taxes.index') }}">{{ trans('tax::taxes.taxes') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('tax::taxes.tax')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.taxes.update', $taxClass) }}" class="form-horizontal" id="tax-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('taxClass')) !!}
    </form>
@endsection

@include('tax::admin.taxes.partials.shortcuts')
