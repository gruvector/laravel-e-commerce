@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('currency::currency_rates.currency_rate')]))
    @slot('subtitle', $currencyRate->currency)

    <li><a href="{{ route('admin.currency_rates.index') }}">{{ trans('currency::currency_rates.currency_rates') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('currency::currency_rates.currency_rate')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.currency_rates.update', $currencyRate) }}" class="form-horizontal" id="currency-rate-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('currencyRate')) !!}
    </form>
@endsection

@push('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('admin::admin.shortcuts.back_to_index', ['name' => trans('currency::currency_rates.currency_rate')]) }}</dd>
    </dl>
@endpush

@push('scripts')
    <script>
        keypressAction([
            { key: 'b', route: "{{ route('admin.currency_rates.index') }}" }
        ]);
    </script>
@endpush
