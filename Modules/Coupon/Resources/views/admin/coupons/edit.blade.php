@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('coupon::coupons.coupon')]))
    @slot('subtitle', $coupon->name)

    <li><a href="{{ route('admin.coupons.index') }}">{{ trans('coupon::coupons.coupons') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('coupon::coupons.coupon')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}" class="form-horizontal" id="coupon-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('coupon')) !!}
    </form>
@endsection

@include('coupon::admin.coupons.partials.scripts')
