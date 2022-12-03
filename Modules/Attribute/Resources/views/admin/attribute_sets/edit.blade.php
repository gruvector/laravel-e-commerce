@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('attribute::attribute_sets.attribute_set')]))
    @slot('subtitle', $attributeSet->name)

    <li><a href="{{ route('admin.attribute_sets.index') }}">{{ trans('attribute::attribute_sets.attribute_sets') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('attribute::attribute_sets.attribute_set')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.attribute_sets.update', $attributeSet) }}" class="form-horizontal" id="attribute-set-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('attributeSet')) !!}
    </form>
@endsection

@include('attribute::admin.attributes.partials.shortcuts')
