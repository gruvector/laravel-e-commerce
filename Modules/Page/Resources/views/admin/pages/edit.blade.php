@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('page::pages.page')]))
    @slot('subtitle', $page->title)

    <li><a href="{{ route('admin.pages.index') }}">{{ trans('page::pages.pages') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('page::pages.page')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="form-horizontal" id="page-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('page')) !!}
    </form>
@endsection

@include('page::admin.pages.partials.shortcuts')
