<div class="box-body index-table" id="media-table">
    @component('admin::components.table')
        @slot('thead')
            <tr>
                @include('admin::partials.table.select_all')

                <th data-sort>{{ trans('admin::admin.table.id') }}</th>
                <th>{{ trans('media::media.table.thumbnail') }}</th>
                <th>{{ trans('media::media.table.filename') }}</th>
                <th data-sort>{{ trans('admin::admin.table.created') }}</th>

                @unless (request()->routeIs('admin.media.index'))
                    <th class="min-tablet"></th>
                @endif
            </tr>
        @endslot
    @endcomponent
</div>
