<div class="row">
    @hasAccess('admin.menu_items.index')
        <div class="col-md-6">
            @if ($menu->exists)
                @hasAccess('admin.menu_items.create')
                    <div class="btn-group pull-right m-b-15">
                        <a href="{{ route('admin.menus.items.create', $menu) }}" class="btn btn-primary">
                            {{ trans('admin::resource.create', ['resource' => trans('menu::menu_items.menu_item')]) }}
                        </a>
                    </div>
                @endHasAccess

                @hasAccess('admin.menu_items.edit')
                    <div class="box box-primary overflow-hidden">
                        <div class="box-body">
                            <div class="dd">
                                @include('menu::admin.menus.form.menu_items_list')
                            </div>
                        </div>
                    </div>
                @endHasAccess
            @else
                <div class="alert alert-info">
                    {{ trans('menu::menus.form.please_save_the_menu_first') }}
                </div>
            @endif
        </div>
    @endHasAccess

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                {{ Form::text('name', trans('menu::attributes.name'), $errors, $menu, ['required' => true]) }}
                {{ Form::checkbox('is_active', trans('menu::attributes.is_active'), trans('menu::menus.form.enable_the_menu'), $errors, $menu) }}

                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-primary" data-loading>
                            {{ trans('admin::admin.buttons.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
