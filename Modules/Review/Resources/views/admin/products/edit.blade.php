@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('review::reviews.review')]))

    <li><a href="{{ route('admin.products.index') }}">{{ trans('product::products.products') }}</a></li>
    <li><a href="{{ route('admin.products.edit', $productId) }}">{{ trans('admin::resource.edit', ['resource' => trans('product::products.product')]) }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('review::reviews.review')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.products.reviews.update', [$productId, $review]) }}" class="form-horizontal" id="review-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('review')) !!}
    </form>
@endsection

@push('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('review::reviews.shortcuts.back_to_product_edit_page') }}</dd>
    </dl>
@endpush

@push('scripts')
    <script>
        keypressAction([
            { key: 'b', route: "{{ route('admin.products.edit', $productId) }}" },
        ]);
    </script>
@endpush
