<script type="text/html" id="product-download-template">
    <tr>
        <td class="text-center">
            <span class="drag-icon">
                <i class="fa">&#xf142;</i>
                <i class="fa">&#xf142;</i>
            </span>
        </td>

        <td>
            <div class="form-group">
                <label class="visible-xs">
                    {{ trans('product::products.form.file') }}
                </label>

                <div class="choose-file-group">
                    <input
                        type="text"
                        value="<%- download.filename %>"
                        class="form-control download-name"
                        readonly
                    >

                    <span class="btn btn-default btn-choose-file">
                        {{ trans('product::products.form.choose') }}
                    </span>

                    <input
                        type="hidden"
                        name="files[downloads][]"
                        value="<%- download.id %>"
                        class="download-file"
                    >
                </div>
            </div>
        </td>

        <td class="text-center">
            <button
                type="button"
                class="btn btn-default delete-row"
                data-toggle="tooltip"
                data-title="{{ trans('product::products.form.delete_file') }}"
            >
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
</script>
