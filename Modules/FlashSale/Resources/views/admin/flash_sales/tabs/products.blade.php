<div class="panel-wrap flash-sale" id="products-wrapper">
    {{-- Products will be added here dynamically using JS --}}
</div>

<div class="form-group">
    <button type="button" class="add-product btn btn-default m-l-15">
        {{ trans('flashsale::flash_sales.form.add_product') }}
    </button>
</div>

@include('admin::partials.selectize_remote')
@include('flashsale::admin.flash_sales.templates.product')

@push('globals')
    <script>
        FleetCart.data['flash_sale.products'] = {!! old_json('products', $flashSale->products) !!};
        FleetCart.errors['flash_sale.products'] = @json($errors->get('products.*'), JSON_FORCE_OBJECT);
    </script>
@endpush
