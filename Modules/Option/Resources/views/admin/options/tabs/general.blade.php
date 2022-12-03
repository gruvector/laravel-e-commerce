<div class="row">
    <div class="col-md-8">
        {{ Form::text('name', trans('option::attributes.name'), $errors, $option, ['required' => true]) }}

        <div class="form-group required">
            <label for="type" class="col-md-3 control-label text-left">
                {{ trans('option::attributes.type') }}<span class="m-l-5 text-red">*</span>
            </label>

            <div class="col-md-9">
                <select name="type" class="form-control custom-select-black" id="type">
                    <option value="" {{ is_null(old('type', $option->type)) ? 'selected' : '' }}>
                        {{ trans('option::options.form.option_types.please_select') }}
                    </option>

                    <optgroup label="{{ trans('option::options.form.option_types.text') }}">
                        <option value="field" {{ old('type', $option->type) === 'field' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.field') }}
                        </option>

                        <option value="textarea" {{ old('type', $option->type) === 'textarea' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.textarea') }}
                        </option>
                    </optgroup>

                    <optgroup label="{{ trans('option::options.form.option_types.select') }}">
                        <option value="dropdown" {{ old('type', $option->type) === 'dropdown' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.dropdown') }}
                        </option>

                        <option value="checkbox" {{ old('type', $option->type) === 'checkbox' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.checkbox') }}
                        </option>

                        <option value="checkbox_custom" {{ old('type', $option->type) === 'checkbox_custom' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.checkbox_custom') }}
                        </option>

                        <option value="radio" {{ old('type', $option->type) === 'radio' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.radio') }}
                        </option>

                        <option value="radio_custom" {{ old('type', $option->type) === 'radio_custom' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.radio_custom') }}
                        </option>

                        <option value="multiple_select" {{ old('type', $option->type) === 'multiple_select' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.multiple_select') }}
                        </option>
                    </optgroup>

                    <optgroup label="{{ trans('option::options.form.option_types.date') }}">
                        <option value="date" {{ old('type', $option->type) === 'date' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.date') }}
                        </option>

                        <option value="date_time" {{ old('type', $option->type) === 'date_time' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.date_time') }}
                        </option>

                        <option value="time" {{ old('type', $option->type) === 'time' ? 'selected' : '' }}>
                            {{ trans('option::options.form.option_types.time') }}
                        </option>
                    </optgroup>
                </select>

                {!! $errors->first('type', '<span class="help-block text-red">:message</span>') !!}
            </div>
        </div>

        {{ Form::checkbox('is_required', trans('option::attributes.is_required'), trans('option::options.form.this_option_is_required'), $errors, $option) }}
    </div>
</div>
