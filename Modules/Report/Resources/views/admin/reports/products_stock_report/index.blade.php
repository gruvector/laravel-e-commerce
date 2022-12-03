@extends('report::admin.reports.layout')

@section('filters')
    <div class="form-group">
        <label for="quantity-above">{{ trans('report::admin.filters.quantity_above') }}</label>
        <input type="number" name="quantity_above" class="form-control" id="quantity-above" value="{{ $request->quantity_above }}">
    </div>

    <div class="form-group">
        <label for="quantity-below">{{ trans('report::admin.filters.quantity_below') }}</label>
        <input type="number" name="quantity_below" class="form-control" id="quantity-below" value="{{ $request->quantity_below }}">
    </div>

    <div class="form-group">
        <label for="stock-availability">{{ trans('report::admin.filters.stock_availability') }}</label>

        <select name="stock_availability" class="form-control custom-select-black" id="stock-availability">
            <option value="">{{ trans('report::admin.filters.please_select') }}</option>

            <option value="in_stock" {{ request('stock_availability') === 'in_stock' ? 'selected' : '' }}>
                {{ trans('report::admin.filters.stock_availability_states.in_stock') }}
            </option>

            <option value="out_of_stock" {{ request('stock_availability') === 'out_of_stock' ? 'selected' : '' }}>
                {{ trans('report::admin.filters.stock_availability_states.out_of_stock') }}
            </option>
        </select>
    </div>
@endsection

@section('report_result')
    <h3 class="tab-content-title">
        {{ trans('report::admin.filters.report_types.products_stock_report') }}
    </h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('report::admin.table.product') }}</th>
                    <th>{{ trans('report::admin.table.qty') }}</th>
                    <th>{{ trans('report::admin.table.stock_availability') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $product)
                    <tr>
                        <td>
                            @if ($product->trashed())
                                {{ $product->name }}
                            @else
                                <a href="{{ route('admin.products.edit', $product) }}">{{ $product->name }}</a>
                            @endif
                        </td>

                        <td>
                            {!! $product->qty ?: '&mdash;' !!}
                        </td>

                        <td>
                            @if ($product->isInStock())
                                {{ trans('report::admin.filters.stock_availability_states.in_stock') }}
                            @else
                                {{ trans('report::admin.filters.stock_availability_states.out_of_stock') }}
                            @endif
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
