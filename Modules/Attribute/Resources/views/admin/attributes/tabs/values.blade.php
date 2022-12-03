<div id="attribute-values-wrapper">
    <div class="table-responsive">
        <table class="options table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ trans('attribute::admin.form.value') }}</th>
                    <th></th>
                </tr>
            </thead>

            <tbody id="attribute-values">

            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-default" id="add-new-value">
        {{ trans('attribute::admin.form.add_new_value') }}
    </button>
</div>

@include('attribute::admin.attributes.tabs.templates.attribute_value')

@push('globals')
    <script>
        FleetCart.data['attribute.values'] = {!! old_json('values', $attribute->values) !!};
    </script>
@endpush
