<div class="dashboard-panel">
    <div class="grid-header">
        <h4><i class="fa fa-search" aria-hidden="true"></i>{{ trans('admin::dashboard.latest_search_terms') }}</h4>
    </div>

    <div class="clearfix"></div>

    <div class="table-responsive search-terms">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('admin::dashboard.table.latest_search_terms.keyword') }}</th>
                    <th>{{ trans('admin::dashboard.table.latest_search_terms.results') }}</th>
                    <th>{{ trans('admin::dashboard.table.latest_search_terms.hits') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestSearchTerms as $latestSearchTerm)
                    <tr>
                        <td>{{ $latestSearchTerm->term }}</td>
                        <td>{{ $latestSearchTerm->results }}</td>
                        <td>{{ $latestSearchTerm->hits }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="5">{{ trans('admin::dashboard.no_data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
