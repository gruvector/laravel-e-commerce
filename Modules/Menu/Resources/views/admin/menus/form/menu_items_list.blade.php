<ol class="dd-list">
    @foreach ($menuItems as $menuItem)
        <li class="dd-item" data-id="{{ $menuItem->id }}">
            @if (! $menuItem->is_root)
                <div class="menu-item-actions btn-group" role="group">
                    <a href="{{ route('admin.menus.items.edit', [$menu->id, $menuItem->id]) }}" class="btn edit-menu-item ">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <button type="button" class="btn delete-menu-item" data-action="{{ route('admin.menus.items.destroy', [$menu->id, $menuItem->id]) }}">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="{{ $menuItem->is_root ? 'dd-handle-root' : 'dd-handle' }}">{{ $menuItem->name }}</div>

            @if (count($menuItem->items) !== 0)
                @include('menu::admin.menus.form.menu_items_list', ['menuItems' => $menuItem->items])
            @endif
        </li>
    @endforeach
</ol>
