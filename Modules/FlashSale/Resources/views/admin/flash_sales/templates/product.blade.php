<script type="text/html" id="flash-sale-product-template">
    <div class="panel">
        <div class="panel-header clearfix">
            <span class="drag-icon pull-left">
                <i class="fa">&#xf142;</i>
                <i class="fa">&#xf142;</i>
            </span>

            {{ trans('flashsale::flash_sales.form.flash_sale_product') }}

            <button type="button" class="delete-product-panel btn pull-right">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="products-<%- productPanelNumber %>-product-id">
                            {{ trans('flashsale::attributes.product') }}<span class="m-l-5 text-red">*</span>
                        </label>

                        <input type="hidden"
                            name="products[<%- productPanelNumber %>][name]"
                            class="form-control"
                            id="products-<%- productPanelNumber %>-name"
                            value="<%- product.name %>"
                        >

                        <select name="products[<%- productPanelNumber %>][product_id]"
                            class="form-control selectize prevent-creation"
                            id="products-<%- productPanelNumber %>-product-id"
                            data-url="{{ route('admin.products.index') }}"
                        >
                            <% if (product.id !== null && product.name !== null) { %>
                                <option value="<%- product.id %>"><%- product.name %></option>
                            <% } %>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="products-<%- productPanelNumber %>-campaign-end">
                            {{ trans('flashsale::attributes.end_date') }}<span class="m-l-5 text-red">*</span>
                        </label>

                        <input type="text"
                            name="products[<%- productPanelNumber %>][end_date]"
                            class="form-control datetime-picker"
                            id="products-<%- productPanelNumber %>-campaign-end"
                            value="<%- product.pivot.end_date %>"
                        >
                    </div>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label for="products-<%- productPanelNumber %>-price">
                            {{ trans('flashsale::attributes.price') }}<span class="m-l-5 text-red">*</span>
                        </label>

                        <input type="number"
                            name="products[<%- productPanelNumber %>][price]"
                            class="form-control"
                            id="products-<%- productPanelNumber %>-price"
                            value="<%- product.pivot.price.amount %>"
                            min="0"
                        >
                    </div>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label for="products-<%- productPanelNumber %>-qty">
                            {{ trans('flashsale::attributes.quantity') }}<span class="m-l-5 text-red">*</span>
                        </label>

                        <input type="number"
                            name="products[<%- productPanelNumber %>][qty]"
                            class="form-control"
                            id="products-<%- productPanelNumber %>-qty"
                            value="<%- product.pivot.qty %>"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
