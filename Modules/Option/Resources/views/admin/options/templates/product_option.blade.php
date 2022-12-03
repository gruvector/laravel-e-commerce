<script type="text/html" id="option-template">
    <div class="content-accordion panel-group options-group-wrapper" id="option-<%- optionId %>">
        <div class="panel panel-default option">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#option-<%- optionId %>" href="#custom-collapse-<%- optionId %>">
                        <span class="drag-icon pull-left">
                            <i class="fa">&#xf142;</i>
                            <i class="fa">&#xf142;</i>
                        </span>

                        <span id="option-name" class="pull-left">{{ trans('option::options.form.new_option') }}</span>
                    </a>
                </h4>
            </div>

            <div id="custom-collapse-<%- optionId %>" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class="new-option clearfix">
                        <input type="hidden" name="options[<%- optionId %>][id]" value="<%- option.id %>">

                        <div class="col-lg-6 col-md-12 p-l-0">
                            <div class="form-group">
                                <label for="option-<%- optionId %>-name">{{ trans('option::attributes.name') }}</label>
                                <input type="text" name="options[<%- optionId %>][name]" class="form-control option-name-field" id="option-<%- optionId %>-name" value="<%- option.name %>">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12 p-l-0">
                            <div class="form-group">
                                <label for="option-<%- optionId %>-type">{{ trans('option::attributes.type') }}</label>

                                <select name="options[<%- optionId %>][type]" class="form-control custom-select-black" id="option-<%- optionId %>-type">
                                    <option value=""
                                        <%= option.type === null ? 'selected' : '' %>
                                    >
                                        {{ trans('option::options.form.option_types.please_select') }}
                                    </option>

                                    <optgroup label="{{ trans('option::options.form.option_types.text') }}">
                                        <option value="field"
                                            <%= option.type === 'field' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.field') }}
                                        </option>

                                        <option value="textarea"
                                            <%= option.type === 'textarea' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.textarea') }}
                                        </option>
                                    </optgroup>

                                    <optgroup label="{{ trans('option::options.form.option_types.select') }}">
                                        <option value="dropdown"
                                            <%= option.type === 'dropdown' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.dropdown') }}
                                        </option>

                                        <option value="checkbox"
                                            <%= option.type === 'checkbox' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.checkbox') }}
                                        </option>

                                        <option value="checkbox_custom"
                                            <%= option.type === 'checkbox_custom' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.checkbox_custom') }}
                                        </option>

                                        <option value="radio"
                                            <%= option.type === 'radio' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.radio') }}
                                        </option>

                                        <option value="radio_custom"
                                            <%= option.type === 'radio_custom' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.radio_custom') }}
                                        </option>

                                        <option value="multiple_select"
                                            <%= option.type === 'multiple_select' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.multiple_select') }}
                                        </option>
                                    </optgroup>

                                    <optgroup label="{{ trans('option::options.form.option_types.date') }}">
                                        <option value="date"
                                            <%= option.type === 'date' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.date') }}
                                        </option>

                                        <option value="date_time"
                                            <%= option.type === 'date_time' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.date_time') }}
                                        </option>

                                        <option value="time"
                                            <%= option.type === 'time' ? 'selected' : '' %>
                                        >
                                            {{ trans('option::options.form.option_types.time') }}
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="checkbox">
                            <input type="hidden" name="options[<%- optionId %>][is_required]" value="0">

                            <input type="checkbox"
                                name="options[<%- optionId %>][is_required]"
                                class="form-control"
                                id="option-<%- optionId %>-is-required"
                                value="1"
                                <%= option.is_required ? 'checked' : '' %>
                            >

                            <label for="option-<%- optionId %>-is-required">{{ trans('option::attributes.is_required') }}</label>
                        </div>

                        <button type="button" class="btn btn-default delete-option pull-right" data-toggle="tooltip" title="{{ trans('option::options.form.delete_option') }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="option-values clearfix" id="option-<%- optionId %>-values">
                        {{-- Custom option values will be added here dynamically using JS --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

@include('option::admin.options.templates.option.text')
@include('option::admin.options.templates.option.select')
@include('option::admin.options.templates.option.select_values')
