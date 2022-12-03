@extends('report::admin.reports.layout')

@section('filters')
    @include('report::admin.reports.filters.from')
    @include('report::admin.reports.filters.to')
    @include('report::admin.reports.filters.status')
    @include('report::admin.reports.filters.group')

    <div class="form-group">
        <label for="customer-name">{{ trans('report::admin.filters.customer_name') }}</label>
        <input type="text" name="customer_name" class="form-control" id="customer-name" value="{{ $request->customer_name }}">
    </div>

    <div class="form-group">
        <label for="customer-email">{{ trans('report::admin.filters.customer_email') }}</label>
        <input type="text" name="customer_email" class="form-control" id="customer-email" value="{{ $request->customer_email }}">
    </div>
@endsection

@section('report_result')
    <h3 class="tab-content-title">
        {{ trans('report::admin.filters.report_types.customers_order_report') }}
    </h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('report::admin.table.date') }}</th>
                    <th>{{ trans('report::admin.table.customer_name') }}</th>
                    <th>{{ trans('report::admin.table.customer_email') }}</th>
                    <th>{{ trans('report::admin.table.customer_group') }}</th>
                    <th>{{ trans('report::admin.table.orders') }}</th>
                    <th>{{ trans('report::admin.table.products') }}</th>
                    <th>{{ trans('report::admin.table.total') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $data)
                    <tr>
                        <td>{{ $data->start_date->toFormattedDateString() }} - {{ $data->end_date->toFormattedDateString() }}</td>
                        <td>{{ $data->customer_full_name }}</td>
                        <td>{{ $data->customer_email }}</td>
                        <td>{{ is_null($data->customer_id) ? trans('report::admin.table.guest') : trans('report::admin.table.registered') }}</td>
                        <td>{{ $data->total_orders }}</td>
                        <td>{{ $data->total_products }}</td>
                        <td>{{ $data->total->format() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="8">{{ trans('report::admin.no_data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pull-right">
            {!! $report->links() !!}
        </div>
    </div>
@endsection
