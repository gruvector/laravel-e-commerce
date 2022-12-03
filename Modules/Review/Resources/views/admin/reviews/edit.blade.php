@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('review::reviews.review')]))

    <li><a href="{{ route('admin.reviews.index') }}">{{ trans('review::reviews.reviews') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('review::reviews.review')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.reviews.update', $review) }}" class="form-horizontal" id="review-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('review')) !!}
    </form>
@endsection

@push('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('admin::admin.shortcuts.back_to_index', ['name' => trans('review::reviews.review')]) }}</dd>
    </dl>
@endpush

@push('scripts')
    <script>
        keypressAction([
            { key: 'b', route: "{{ route('admin.reviews.index') }}" },
        ]);
    </script>
@endpush
