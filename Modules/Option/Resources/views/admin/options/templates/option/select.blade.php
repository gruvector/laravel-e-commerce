<script type="text/html" id="option-select-template">
    <div class="option-select <% if (optionId === undefined) { %> m-b-15 <% } %>">
        <div class="table-responsive">
            <table class="options table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ trans('option::attributes.label') }}</th>
                        <th>{{ trans('option::attributes.price') }}</th>
                        <th>{{ trans('option::attributes.price_type') }}</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody
                    <% if (optionId === undefined) { %>
                        id="select-values"
                    <% } else { %>
                        id="option-<%- optionId %>-select-values"
                    <% } %>
                >
                    {{--  Custom option dropdown rows will be added here dynamically using JS  --}}
                </tbody>
            </table>
        </div>

        <button
            type="button"
            class="btn btn-default"
            <% if (optionId === undefined) { %>
                id="add-new-row"
            <% } else { %>
                id="option-<%- optionId %>-add-new-row"
            <% } %>
        >
            {{ trans('option::options.form.add_new_row') }}
        </button>
    </div>
</script>
