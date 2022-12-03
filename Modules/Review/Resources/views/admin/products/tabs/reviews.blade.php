@component('admin::components.table', ['id' => 'product-reviews-table'])
    @slot('thead')
        <tr>
            @include('admin::partials.table.select_all')

            <th>{{ trans('review::reviews.table.reviewer_name') }}</th>
            <th>{{ trans('review::reviews.table.rating') }}</th>
            <th>{{ trans('review::reviews.table.approved') }}</th>
            <th data-sort>{{ trans('admin::admin.table.date') }}</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        Mousetrap.bind('del', function () {
            $('#product-reviews-table_wrapper .btn-delete').trigger('click');
        });

        DataTable.setRoutes('#product-reviews-table', {
            index: {
                name: 'admin.reviews.index',
                params: { productId: '{{ $product->id }}' }
            },
            edit: { name: 'admin.reviews.edit' },
            destroy: { name: 'admin.reviews.destroy' },
        });

        new DataTable('#product-reviews-table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'reviewer_name' },
                { data: 'rating' },
                { data: 'status', name: 'is_approved', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
