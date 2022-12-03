<div class="option-values clearfix" id="option-values">
    <div class="alert alert-info" id="option-values-info">
        {{ trans('option::options.please_select_a_option_type') }}
    </div>
</div>

@include('option::admin.options.templates.option.text')
@include('option::admin.options.templates.option.select')
@include('option::admin.options.templates.option.select_values')
