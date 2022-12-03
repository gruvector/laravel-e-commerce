@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('tag::tags.tag')]))
    @slot('subtitle', $tag->name)

    <li><a href="{{ route('admin.tags.index') }}">{{ trans('tag::tags.tags') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('tag::tags.tag')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.tags.update', $tag) }}" class="form-horizontal" id="tag-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('tag')) !!}
    </form>
@endsection

@include('tag::admin.tags.partials.shortcuts')
