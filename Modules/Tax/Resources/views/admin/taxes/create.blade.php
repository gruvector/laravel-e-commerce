@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('tax::taxes.tax')]))

    <li><a href="{{ route('admin.taxes.index') }}">{{ trans('tax::taxes.taxes') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('tax::taxes.tax')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.taxes.store') }}" class="form-horizontal" id="tax-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('taxClass')) !!}
    </form>
@endsection

@include('tax::admin.taxes.partials.shortcuts')
