@extends('report::admin.reports.layout')

@section('filters')
    <div class="form-group">
        <label for="category">{{ trans('report::admin.filters.category') }}</label>

        <input type="text" name="category" class="form-control" id="category" value="{{ $request->category }}">
    </div>
@endsection

@section('report_result')
    <h3 class="tab-content-title">
        {{ trans('report::admin.filters.report_types.categorized_products_report') }}
    </h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('report::admin.table.category') }}</th>
                    <th>{{ trans('report::admin.table.products_count') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $category)
                    <tr>
                        <td>
                            {{ $category->name }}
                        </td>

                        <td>
                            {{ $category->products_count }}
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
