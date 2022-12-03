@extends('admin::layout')

@section('title', trans('setting::settings.settings'))

@section('content_header')
    <h3>{{ trans('setting::settings.settings') }}</h3>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}">{{ trans('admin::dashboard.dashboard') }}</a></li>
        <li class="active">{{ trans('setting::settings.settings') }}</li>
    </ol>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" class="form-horizontal" id="settings-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('settings')) !!}
    </form>
@endsection
