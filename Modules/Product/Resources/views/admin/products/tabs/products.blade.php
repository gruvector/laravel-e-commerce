@component('admin::components.table')
    @slot('thead')
        @include('product::admin.products.partials.thead')
    @endslot
@endcomponent

@push('scripts')
    <script>
        @if ($name === 'related_products')
            DataTable.setSelectedIds('#related_products .table', {!! old_json('related_products', $product->relatedProductList(), JSON_NUMERIC_CHECK) !!});
        @elseif ($name === 'up_sells')
            DataTable.setSelectedIds('#up_sells .table', {!! old_json('up_sells', $product->upSellProductList(), JSON_NUMERIC_CHECK) !!});
        @elseif ($name === 'cross_sells')
            DataTable.setSelectedIds('#cross_sells .table', {!! old_json('cross_sells', $product->crossSellProductList(), JSON_NUMERIC_CHECK) !!});
        @endif

        DataTable.setRoutes('#{{ $name }} .table', {
            index: { name: 'admin.products.index', params: { except: {!! $product->id ?? "''" !!} } },
            edit: 'admin.products.edit',
            destroy: 'admin.products.destroy',
        });

        new DataTable('#{{ $name }} .table', {
            pageLength: 10,
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'thumbnail', orderable: false, searchable: false, width: '10%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'price', searchable: false },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
