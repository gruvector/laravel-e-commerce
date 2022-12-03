@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('option::options.options'))

    <li class="active">{{ trans('option::options.options') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'options')
    @slot('name', trans('option::options.option'))

    @slot('thead')
        <tr>
            @include('admin::partials.table.select_all')

            <th>{{ trans('admin::admin.table.id') }}</th>
            <th>{{ trans('option::options.table.name') }}</th>
            <th>{{ trans('option::options.table.type') }}</th>
            <th data-sort>{{ trans('admin::admin.table.created') }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#options-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'type', name: 'type' },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
