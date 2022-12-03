<script type="text/html" id="option-text-template">
    <div class="table-responsive option-text">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ trans('option::attributes.price') }}</th>
                    <th>{{ trans('option::attributes.price_type') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input
                            type="number"
                            <% if (optionId === undefined) { %>
                                name="values[0][price]"
                                id="values-0-price"
                            <% } else { %>
                                name="options[<%- optionId %>][values][0][price]"
                                id="option-<%- optionId %>-values-0-price"
                            <% } %>
                            class="form-control"
                            value="<%- _.isObject(value.price) ? value.price.amount : value.price %>"
                        >
                    </td>
                    <td>
                        <select
                            <% if (optionId === undefined) { %>
                                name="values[0][price_type]"
                                id="values-0-price-type"
                            <% } else { %>
                                name="options[<%- optionId %>][values][0][price_type]"
                                id="option-<%- optionId %>-values-0-price-type"
                            <% } %>
                            class="form-control custom-select-black"
                        >
                            <option value="fixed"
                                <%= value.price_type === 'fixed' ? 'selected' : '' %>
                            >
                                {{ trans('option::options.form.price_types.fixed') }}
                            </option>

                            <option value="percent"
                                <%= value.price_type === 'percent' ? 'selected' : '' %>
                            >
                                {{ trans('option::options.form.price_types.percent') }}
                            </option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</script>
