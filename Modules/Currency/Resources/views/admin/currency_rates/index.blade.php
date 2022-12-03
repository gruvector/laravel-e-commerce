@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('currency::currency_rates.currency_rates'))

    <li class="active">{{ trans('currency::currency_rates.currency_rates') }}</li>
@endcomponent

@section('content')
    <div class="row">
        <div class="btn-group pull-right">
            <button id="refresh-rates" class="btn btn-primary btn-actions" data-loading>
                {{ trans('currency::currency_rates.refresh_rates') }}
            </button>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body index-table" id="currency-rates-table">
            @component('admin::components.table')
                @slot('thead')
                    <tr>
                        <th>{{ trans('currency::currency_rates.table.currency') }}</th>
                        <th data-sort="asc">{{ trans('currency::currency_rates.table.code') }}</th>
                        <th>{{ trans('currency::currency_rates.table.rate') }}</th>
                        <th>{{ trans('currency::currency_rates.table.last_updated') }}</th>
                    </tr>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        DataTable.setRoutes('#currency-rates-table .table', {
            index: 'admin.currency_rates.index',
            edit: 'admin.currency_rates.edit',
        });

        new DataTable('#currency-rates-table .table', {
            columns: [
                { data: 'currency_name', orderable: false, searchable: false },
                { data: 'currency' },
                { data: 'rate', searchable: false },
                { data: 'updated_at', searchable: false },
            ],
        });
    </script>
@endpush
