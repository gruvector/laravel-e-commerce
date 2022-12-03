@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('option::options.option')]))
    @slot('subtitle', $option->name)

    <li><a href="{{ route('admin.options.index') }}">{{ trans('option::options.options') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('option::options.option')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.options.update', $option) }}" class="form-horizontal" id="option-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('option')) !!}
    </form>
@endsection

@include('option::admin.options.partials.scripts')
