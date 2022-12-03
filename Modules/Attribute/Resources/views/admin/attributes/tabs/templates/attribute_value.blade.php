<script type="text/html" id="attribute-value-template">
    <tr>
        <td class="text-center">
            <span class="drag-icon">
                <i class="fa">&#xf142;</i>
                <i class="fa">&#xf142;</i>
            </span>
        </td>

        <td>
            <input type="hidden" name="values[<%- valueId %>][id]" value="<%- value.id %>">

            <div class="form-group">
                <input type="text" name="values[<%- valueId %>][value]" value="<%- value.value %>" class="form-control">
            </div>
        </td>

        <td class="text-center">
            <button type="button" class="btn btn-default delete-row" data-toggle="tooltip" data-title="{{ trans('attribute::admin.form.delete_value') }}">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
</script>
