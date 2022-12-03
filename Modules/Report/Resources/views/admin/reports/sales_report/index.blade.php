@extends('report::admin.reports.layout')

@section('filters')
    @include('report::admin.reports.filters.from')
    @include('report::admin.reports.filters.to')
    @include('report::admin.reports.filters.status')
    @include('report::admin.reports.filters.group')
@endsection

@section('report_result')
    <h3 class="tab-content-title">
        {{ trans('report::admin.filters.report_types.sales_report') }}
    </h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('report::admin.table.date') }}</th>
                    <th>{{ trans('report::admin.table.orders') }}</th>
                    <th>{{ trans('report::admin.table.products') }}</th>
                    <th>{{ trans('report::admin.table.subtotal') }}</th>
                    <th>{{ trans('report::admin.table.shipping') }}</th>
                    <th>{{ trans('report::admin.table.discount') }}</th>
                    <th>{{ trans('report::admin.table.tax') }}</th>
                    <th>{{ trans('report::admin.table.total') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $data)
                    <tr>
                        <td>{{ $data->start_date->toFormattedDateString() }} - {{ $data->end_date->toFormattedDateString() }}</td>
                        <td>{{ $data->total_orders }}</td>
                        <td>{{ $data->total_products }}</td>
                        <td>{{ $data->sub_total->format() }}</td>
                        <td>{{ $data->shipping_cost->format() }}</td>
                        <td>{{ $data->discount->format() }}</td>
                        <td>{{ $data->tax->format() }}</td>
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
