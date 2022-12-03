@push('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('menu::menu_items.back_to_menu_edit_page') }}</dd>
    </dl>
@endpush

@push('scripts')
    <script>
        keypressAction([
            { key: 'b', route: "{{ route('admin.menus.edit', $menuId) }}" },
        ]);
    </script>
@endpush
