@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('attribute::admin.attribute')]))

    <li><a href="{{ route('admin.attributes.index') }}">{{ trans('attribute::admin.attributes') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('attribute::admin.attribute')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.attributes.store') }}" class="form-horizontal" id="attribute-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('attribute')) !!}
    </form>
@endsection

@include('attribute::admin.attributes.partials.shortcuts')
