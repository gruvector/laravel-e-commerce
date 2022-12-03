<script type="text/html" id="option-select-values-template">
    <tr class="option-row">
        <td class="text-center">
            <span class="drag-icon">
                <i class="fa">&#xf142;</i>
                <i class="fa">&#xf142;</i>
            </span>
        </td>
        <td>
            <input
                type="hidden"
                <% if (optionId === undefined) { %>
                    name="values[<%- valueId %>][id]"
                    id="values-<%- valueId %>-id"
                <% } else { %>
                    name="options[<%- optionId %>][values][<%- valueId %>][id]"
                    id="option-<%- optionId %>-values-<%- valueId %>-id"
                <% } %>

                value="<%- value.id %>"
            >

            <input
                type="text"
                <% if (optionId === undefined) { %>
                    name="values[<%- valueId %>][label]"
                    id="values-<%- valueId %>-label"
                <% } else { %>
                    name="options[<%- optionId %>][values][<%- valueId %>][label]"
                    id="option-<%- optionId %>-values-<%- valueId %>-label"
                <% } %>

                class="form-control"
                value="<%- value.label %>"
            >
        </td>
        <td>
            <input
                type="number"
                <% if (optionId === undefined) { %>
                    name="values[<%- valueId %>][price]"
                    id="values-<%- valueId %>-price"
                <% } else { %>
                    name="options[<%- optionId %>][values][<%- valueId %>][price]"
                    id="option-<%- optionId %>-values-<%- valueId %>-price"
                <% } %>
                class="form-control"
                value="<%- _.isObject(value.price) ? value.price.amount : value.price %>"
                step="0.01"
                min="0"
            >
        </td>
        <td>
            <select
                <% if (optionId === undefined) { %>
                    name="values[<%- valueId %>][price_type]"
                    id="values-<%- valueId %>-price_type"
                <% } else { %>
                    name="options[<%- optionId %>][values][<%- valueId %>][price_type]"
                    id="option-<%- optionId %>-values-<%- valueId %>-price_type"
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
        <td class="text-center">
            <button type="button" class="btn btn-default delete-row" data-toggle="tooltip" title="{{ trans('option::options.form.delete_row') }}">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </td>
</script>
