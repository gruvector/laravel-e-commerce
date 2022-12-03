<div class="row">
    <div class="col-md-8">
        {{ Form::text('name', trans('coupon::attributes.name'), $errors, $coupon, ['required' => true]) }}
        {{ Form::text('code', trans('coupon::attributes.code'), $errors, $coupon, ['required' => true]) }}
        {{ Form::select('is_percent', trans('coupon::attributes.is_percent'), $errors, trans('coupon::coupons.form.price_types'), $coupon) }}
        {{ Form::number('value', trans('coupon::attributes.value'), $errors, $coupon, ['min' => 0]) }}
        {{ Form::checkbox('free_shipping', trans('coupon::attributes.free_shipping'), trans('coupon::coupons.form.allow_free_shipping'), $errors, $coupon->freeShipping()) }}
        {{ Form::text('start_date', trans('coupon::attributes.start_date'), $errors, $coupon, ['class' => 'datetime-picker', 'data-default-date' => $coupon->start_date]) }}
        {{ Form::text('end_date', trans('coupon::attributes.end_date'), $errors, $coupon, ['class' => 'datetime-picker', 'data-default-date' => $coupon->end_date]) }}
        {{ Form::checkbox('is_active', trans('coupon::attributes.is_active'), trans('coupon::coupons.form.enable_the_coupon'), $errors, $coupon) }}
    </div>
</div>
