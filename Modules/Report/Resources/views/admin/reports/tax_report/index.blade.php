@extends('report::admin.reports.layout')

@section('filters')
    @include('report::admin.reports.filters.from')
    @include('report::admin.reports.filters.to')
    @include('report::admin.reports.filters.status')
    @include('report::admin.reports.filters.group')

    <div class="form-group">
        <label for="tax-name">{{ trans('report::admin.filters.tax_name') }}</label>
        <input type="text" name="tax_name" class="form-control" id="tax-name" value="{{ $request->tax_name }}">
    </div>
@endsection

@section('report_result')
    <h3 class="tab-content-title">
        {{ trans('report::admin.filters.report_types.tax_report') }}
    </h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('report::admin.table.date') }}</th>
                    <th>{{ trans('report::admin.table.tax_name') }}</th>
                    <th>{{ trans('report::admin.table.orders') }}</th>
                    <th>{{ trans('report::admin.table.total') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $data)
                    <tr>
                        <td>{{ $data->start_date->toFormattedDateString() }} - {{ $data->end_date->toFormattedDateString() }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->total_orders }}</td>
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
