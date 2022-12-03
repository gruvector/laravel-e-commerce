@push('shortcuts')
    @isset($menu)
        <dl class="dl-horizontal">
            <dt><code>c</code></dt>
            <dd>{{ trans('admin::resource.create', ['resource' => trans('menu::menu_items.menu_item')]) }}</dd>
        </dl>
    @endisset

    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('admin::admin.shortcuts.back_to_index', ['name' => trans('menu::menus.menu')]) }}</dd>
    </dl>
@endpush

@push('scripts')
    <script>
        keypressAction([
            @isset($menu)
                { key: 'c', route: "{{ route('admin.menus.items.create', $menu) }}" },
            @endisset

            { key: 'b', route: "{{ route('admin.menus.index') }}" },
        ]);
    </script>
@endpush
