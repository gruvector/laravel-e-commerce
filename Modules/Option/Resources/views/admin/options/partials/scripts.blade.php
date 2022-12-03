@push('globals')
    <script>
        FleetCart.data['option.values'] = {!! old_json('values', $option->values) !!};
        FleetCart.errors['option.values'] = @json($errors->get('values.*'), JSON_FORCE_OBJECT);
    </script>
@endpush

@push('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('admin::admin.shortcuts.back_to_index', ['name' => trans('option::options.option')]) }}</dd>
    </dl>
@endpush

@push('scripts')
    <script>
        keypressAction([
            { key: 'b', route: "{{ route('admin.options.index') }}" },
        ]);
    </script>
@endpush
