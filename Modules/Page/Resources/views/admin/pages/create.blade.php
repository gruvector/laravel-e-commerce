@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('page::pages.page')]))

    <li><a href="{{ route('admin.pages.index') }}">{{ trans('page::pages.pages') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('page::pages.page')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.pages.store') }}" class="form-horizontal" id="page-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('page')) !!}
    </form>
@endsection

@include('page::admin.pages.partials.shortcuts')
