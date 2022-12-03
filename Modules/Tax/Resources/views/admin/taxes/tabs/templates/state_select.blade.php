<script type="text/html" id="state-select-template">
    <select name="rates[<%- rateId %>][state]" class="form-control custom-select-black" id="rates.<%- rateId %>.state">
        <option value="">{{ trans('admin::admin.form.please_select') }}</option>

        <% _.forEach(states, function (state, code) { %>
            <option value="<%- code %>"><%- state %></option>
        <% }); %>
    </select>
</script>
