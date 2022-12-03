<div class="row">
    <div class="col-md-8">
        {{ Form::number('rate', trans('currency::attributes.rate'), $errors, $currencyRate, ['required' => true]) }}
    </div>
</div>
