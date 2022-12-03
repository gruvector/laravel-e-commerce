@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('media::media.media'))

    <li class="active">{{ trans('media::media.media') }}</li>
@endcomponent

@section('content')
    @include('media::admin.media.partials.uploader')

    <div class="box box-primary">
        <div class="box-header"></div>

        @include('media::admin.media.partials.table')
    </div>
@endsection

@push('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>u</code></dt>
        <dd>{{ trans('media::media.upload_new_file') }}</dd>
    </dl>
@endpush

@push('scripts')
    <script>
        Mousetrap.bind('u', function() {
            $('.dropzone').trigger('click');
        });

        Mousetrap.bind('del', function () {
            $('.btn-delete').trigger('click');
        });

        DataTable.setRoutes('#media-table .table', {
            index: 'admin.media.index',
            destroy: 'admin.media.destroy',
        });

        new DataTable('#media-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'thumbnail', orderable: false, searchable: false, width: '10%' },
                { data: 'filename' },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
