@section('title')
    @isset($subtitle)
        {{  "{$subtitle} - {$title}" }}
    @else
        {{ $title }}
    @endisset
@endsection

@section('content_header')
    <h3>{{ $title }}</h3>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}">{{ trans('admin::dashboard.dashboard') }}</a></li>

        {{ $slot }}
    </ol>
@endsection
