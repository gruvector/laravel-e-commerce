@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('tag::tags.tag')]))

    <li><a href="{{ route('admin.tags.index') }}">{{ trans('tag::tags.tags') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('tag::tags.tag')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.tags.store') }}" class="form-horizontal" id="tag-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('tag')) !!}
    </form>
@endsection

@include('tag::admin.tags.partials.shortcuts')
