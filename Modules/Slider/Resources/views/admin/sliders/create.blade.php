@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('slider::sliders.slider')]))

    <li><a href="{{ route('admin.sliders.index') }}">{{ trans('slider::sliders.sliders') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('slider::sliders.slider')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.sliders.store') }}" class="form-horizontal" id="slider-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('slider')) !!}
    </form>
@endsection

@include('slider::admin.sliders.partials.shortcuts')
