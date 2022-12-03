@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('page::pages.pages'))

    <li class="active">{{ trans('page::pages.pages') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('resource', 'pages')
    @slot('buttons', ['create'])
    @slot('name', trans('page::pages.page'))

    @slot('thead')
        <tr>
            @include('admin::partials.table.select_all')

            <th>{{ trans('admin::admin.table.id') }}</th>
            <th>{{ trans('page::pages.table.name') }}</th>
            <th>{{ trans('admin::admin.table.status') }}</th>
            <th data-sort>{{ trans('admin::admin.table.created') }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#pages-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
