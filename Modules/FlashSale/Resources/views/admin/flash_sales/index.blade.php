@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('flashsale::flash_sales.flash_sales'))

    <li class="active">{{ trans('flashsale::flash_sales.flash_sales') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'flash_sales')
    @slot('name', trans('flashsale::flash_sales.flash_sale'))

    @component('admin::components.table')
        @slot('thead')
            <tr>
                @include('admin::partials.table.select_all')

                <th>{{ trans('admin::admin.table.id') }}</th>
                <th>{{ trans('flashsale::flash_sales.table.campaign_name') }}</th>
                <th data-sort>{{ trans('admin::admin.table.created') }}</th>
            </tr>
        @endslot
    @endcomponent
@endcomponent

@push('scripts')
    <script>
        new DataTable('#flash_sales-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'campaign_name', name: 'translations.campaign_name', orderable: false, defaultContent: '' },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
