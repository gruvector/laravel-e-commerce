@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('attribute::attribute_sets.attribute_sets'))

    <li class="active">{{ trans('attribute::attribute_sets.attribute_sets') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'attribute_sets')
    @slot('name', trans('attribute::attribute_sets.attribute_set'))

    @component('admin::components.table')
        @slot('thead')
            <tr>
                @include('admin::partials.table.select_all')

                <th>{{ trans('admin::admin.table.id') }}</th>
                <th>{{ trans('attribute::attribute_sets.table.name') }}</th>
                <th data-sort>{{ trans('admin::admin.table.created') }}</th>
            </tr>
        @endslot
    @endcomponent
@endcomponent

@push('scripts')
    <script>
        new DataTable('#attribute_sets-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'created', name: 'created_at', width: '30%' },
            ],
        });
    </script>
@endpush
