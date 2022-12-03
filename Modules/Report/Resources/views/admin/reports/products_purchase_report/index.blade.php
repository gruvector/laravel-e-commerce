@extends('report::admin.reports.layout')

@section('filters')
    @include('report::admin.reports.filters.from')
    @include('report::admin.reports.filters.to')
    @include('report::admin.reports.filters.status')
    @include('report::admin.reports.filters.group')

    <div class="form-group">
        <label for="product">{{ trans('report::admin.filters.product') }}</label>
        <input type="text" name="product" class="form-control" id="product" value="{{ $request->product }}">
    </div>

    <div class="form-group">
        <label for="sku">{{ trans('report::admin.filters.sku') }}</label>
        <input type="text" name="sku" class="form-control" id="sku" value="{{ $request->sku }}">
    </div>
@endsection

@section('report_result')
    <h3 class="tab-content-title">
        {{ trans('report::admin.filters.report_types.products_purchase_report') }}
    </h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('report::admin.table.date') }}</th>
                    <th>{{ trans('report::admin.table.product') }}</th>
                    <th>{{ trans('report::admin.table.qty') }}</th>
                    <th>{{ trans('report::admin.table.total') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $product)
                    <tr>
                        <td>{{ $product->start_date->toFormattedDateString() }} - {{ $product->end_date->toFormattedDateString() }}</td>

                        <td>
                            @if ($product->trashed())
                                {{ $product->name }}
                            @else
                                <a href="{{ route('admin.products.edit', $product) }}">{{ $product->name }}</a>
                            @endif
                        </td>

                        <td>{{ $product->qty }}</td>
                        <td>{{ $product->total->format() }}</td>
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
