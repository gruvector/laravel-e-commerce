<div class="row">
    <div class="col-md-8">
        {{ Form::textarea('short_description', trans('product::attributes.short_description'), $errors, $product) }}
        {{ Form::text('new_from', trans('product::attributes.new_from'), $errors, $product, ['class' => 'datetime-picker']) }}
        {{ Form::text('new_to', trans('product::attributes.new_to'), $errors, $product, ['class' => 'datetime-picker'] ) }}
    </div>
</div>
