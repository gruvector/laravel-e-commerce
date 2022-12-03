@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('transaction::transactions.transactions'))

    <li class="active">{{ trans('transaction::transactions.transactions') }}</li>
@endcomponent

@section('content')
    <div class="box box-primary">
        <div class="box-body index-table" id="transactions-table"">
            @component('admin::components.table')
                @slot('thead')
                    <tr>
                        <th>{{ trans('transaction::transactions.table.order_id') }}</th>
                        <th>{{ trans('transaction::transactions.table.transaction_id') }}</th>
                        <th>{{ trans('transaction::transactions.table.payment_method') }}</th>
                        <th data-sort>{{ trans('admin::admin.table.created') }}</th>
                    </tr>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        DataTable.setRoutes('#transactions-table .table', {
            index: '{{ "admin.transactions.index" }}',
        });

        new DataTable('#transactions-table .table', {
            columns: [
                { data: 'order_id' },
                { data: 'transaction_id' },
                { data: 'payment_method' },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
