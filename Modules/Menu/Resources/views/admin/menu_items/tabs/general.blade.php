<div class="row">
    <div class="col-md-8">
        {{ Form::text('name', trans('menu::attributes.name'), $errors, $menuItem, ['required' => true]) }}
        {{ Form::select('type', trans('menu::attributes.type'), $errors, trans('menu::menu_items.form.types'), $menuItem, ['required' => true]) }}

        <div class="link-field category-field {{ old('type', $menuItem->type ?? 'category') !== 'category' ? 'hide' :'' }}">
            {{ Form::select('category_id', trans('menu::attributes.category_id'), $errors, $categories, $menuItem, ['required' => true]) }}
        </div>

        <div class="link-field page-field {{ old('type', $menuItem->type) !== 'page' ? 'hide' :'' }}">
            {{ Form::select('page_id', trans('menu::attributes.page_id'), $errors, $pages, $menuItem, ['required' => true]) }}
        </div>

        <div class="link-field url-field {{ old('type', $menuItem->type) !== 'url' ? 'hide' :'' }}">
            {{ Form::text('url', trans('menu::attributes.url'), $errors, $menuItem, ['required' => true]) }}
        </div>

        {{ Form::text('icon', trans('menu::attributes.icon'), $errors, $menuItem) }}
        {{ Form::checkbox('is_fluid', trans('menu::attributes.is_fluid'), trans('menu::menu_items.form.full_width_menu'), $errors, $menuItem) }}
        {{ Form::select('target', trans('menu::attributes.target'), $errors, trans('menu::menu_items.form.targets'), $menuItem) }}
        {{ Form::select('parent_id', trans('menu::attributes.parent_id'), $errors, $parentMenuItems, $menuItem) }}
        {{ Form::checkbox('is_active', trans('menu::attributes.is_active'), trans('menu::menu_items.form.enable_the_menu_item'), $errors, $menuItem) }}
    </div>
</div>
