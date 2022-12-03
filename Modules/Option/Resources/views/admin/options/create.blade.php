@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('option::options.option')]))

    <li><a href="{{ route('admin.options.index') }}">{{ trans('option::options.options') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('option::options.option')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.options.store') }}" class="form-horizontal" id="option-create-form" novalidate>
        {{ csrf_field() }}

        {!! $tabs->render(compact('option')) !!}
    </form>
@endsection

@include('option::admin.options.partials.scripts')
