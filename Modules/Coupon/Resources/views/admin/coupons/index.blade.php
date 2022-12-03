@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('coupon::coupons.coupons'))

    <li class="active">{{ trans('coupon::coupons.coupons') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'coupons')
    @slot('name', trans('coupon::coupons.coupon'))

    @slot('thead')
        <tr>
            @include('admin::partials.table.select_all')

            <th data-sort>{{ trans('admin::admin.table.id') }}</th>
            <th>{{ trans('coupon::coupons.table.name') }}</th>
            <th>{{ trans('coupon::coupons.table.code') }}</th>
            <th>{{ trans('coupon::coupons.table.discount') }}</th>
            <th>{{ trans('admin::admin.table.status') }}</th>
            <th data-sort>{{ trans('admin::admin.table.created') }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#coupons-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'code' },
                { data: 'discount', name: 'value' },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
