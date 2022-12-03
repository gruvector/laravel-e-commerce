@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('review::reviews.reviews'))

    <li class="active">{{ trans('review::reviews.reviews') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('resource', 'reviews')
    @slot('name', trans('review::reviews.review'))

    @slot('thead')
        <tr>
            @include('admin::partials.table.select_all')

            <th>{{ trans('admin::admin.table.id') }}</th>
            <th>{{ trans('review::reviews.table.product') }}</th>
            <th>{{ trans('review::reviews.table.reviewer_name') }}</th>
            <th>{{ trans('review::reviews.table.rating') }}</th>
            <th>{{ trans('review::reviews.table.approved') }}</th>
            <th data-sort>{{ trans('admin::admin.table.date') }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#reviews-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'product', name: 'product.price', orderable: false, searchable: false, defaultContent: '' },
                { data: 'reviewer_name' },
                { data: 'rating' },
                { data: 'status', name: 'is_approved', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
