@extends('report::admin.reports.layout')

@section('filters')
    <div class="form-group">
        <label for="brand">{{ trans('report::admin.filters.brand') }}</label>

        <input type="text" name="brand" class="form-control" id="brand" value="{{ $request->brand }}">
    </div>
@endsection

@section('report_result')
    <h3 class="tab-content-title">
        {{ trans('report::admin.filters.report_types.branded_products_report') }}
    </h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('report::admin.table.brand') }}</th>
                    <th>{{ trans('report::admin.table.products_count') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $brand)
                    <tr>
                        <td>
                            {{ $brand->name }}
                        </td>

                        <td>
                            {{ $brand->products_count }}
                        </td>
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
