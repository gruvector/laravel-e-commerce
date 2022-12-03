<div class="row">
    <div class="col-md-8">
        {{ Form::number('minimum_spend', trans('coupon::attributes.minimum_spend'), $errors, $coupon, ['min' => 0]) }}
        {{ Form::number('maximum_spend', trans('coupon::attributes.maximum_spend'), $errors, $coupon, ['min' => 0]) }}
        {{ Form::select('products', trans('coupon::attributes.products'), $errors, $products, $coupon, ['class' => 'selectize prevent-creation', 'data-url' => route('admin.products.index'), 'multiple' => true]) }}
        {{ Form::select('exclude_products', trans('coupon::attributes.exclude_products'), $errors, $excludeProducts, $coupon, ['class' => 'selectize prevent-creation', 'data-url' => route('admin.products.index'), 'multiple' => true]) }}
        {{ Form::select('categories', trans('coupon::attributes.categories'), $errors, $categories, $coupon, ['class' => 'selectize prevent-creation', 'multiple' => true]) }}
        {{ Form::select('exclude_categories', trans('coupon::attributes.exclude_categories'), $errors, $categories, $coupon, ['class' => 'selectize prevent-creation', 'multiple' => true]) }}
    </div>
</div>
