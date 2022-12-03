<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <meta charset="UTF-8">

    <title>{{ trans('media::media.file_manager.title') }}</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:600|Roboto" rel="stylesheet">

    @foreach ($assets->allCss() as $css)
        <link media="all" type="text/css" rel="stylesheet" href="{{ v($css) }}">
    @endforeach

    @include('admin::partials.globals')
</head>

<body class="file-manager">
    <div class="container">
        @include('media::admin.media.partials.uploader')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    @include('media::admin.media.partials.table')
                </div>
            </div>
        </div>
    </div>

    <div id="notification-toast"></div>

    @include('admin::partials.confirmation_modal')

    @foreach ($assets->allJs() as $js)
        <script src="{{ v($js) }}"></script>
    @endforeach

    <script>
        DataTable.setRoutes('.file-manager .table', {
            index: {
                name: 'admin.media.index',
                params: { type: '{{ $type }}' }
            },
            destroy: 'admin.media.destroy',
        });

        new DataTable('.file-manager .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'thumbnail', orderable: false, searchable: false, width: '10%' },
                { data: 'filename', name: 'filename' },
                { data: 'created', name: 'created_at' },
                { data: 'action', orderable: false, searchable: false },
            ],
        });
    </script>
</body>
</html>
