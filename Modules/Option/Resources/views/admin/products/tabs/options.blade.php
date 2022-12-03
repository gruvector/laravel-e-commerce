<div id="options-group">
    {{--  Options will be added here dynamically using JS  --}}
</div>

<div class="box-footer no-border p-t-0">
    <div class="form-group pull-left">
        <div class="col-md-10">
            <button type="button" class="btn btn-default m-r-10" id="add-new-option">
                {{ trans('option::options.form.add_new_option') }}
            </button>
        </div>
    </div>

    @hasAccess('admin.options.index')
        @if ($globalOptions->isNotEmpty())
            <div class="add-global-option clearfix pull-right">
                <div class="form-group pull-left">
                    <select class="form-control custom-select-black" id="global-option">
                        <option value="">{{ trans('option::options.select_global_option') }}</option>

                        @foreach ($globalOptions as $globalOption)
                            <option value="{{ $globalOption->id }}">{{ $globalOption->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="button" class="btn btn-default" id="add-global-option" data-loading>
                    {{ trans('option::options.form.add_global_option') }}
                </button>
            </div>
        @endif
    @endHasAccess
</div>

@push('globals')
    <script>
        FleetCart.data['product.options'] = {!! old_json('options', $product->options) !!};
        FleetCart.errors['product.options'] = @json($errors->get('options.*'), JSON_FORCE_OBJECT);
    </script>
@endpush

@include('option::admin.options.templates.product_option')
