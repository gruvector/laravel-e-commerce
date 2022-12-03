<div class="tax-rates-wrapper">
    <div class="table-responsive">
        <table class="options tax-rates table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ trans('tax::attributes.name') }}</th>
                    <th>{{ trans('tax::attributes.country') }}</th>
                    <th class="state">{{ trans('tax::attributes.state') }}</th>
                    <th class="city">{{ trans('tax::attributes.city') }}</th>
                    <th class="zip">{{ trans('tax::attributes.zip') }}</th>
                    <th class="rate">{{ trans('tax::attributes.rate') }}</th>
                    <th></th>
                </tr>
            </thead>

            <tbody id="tax-rates">
                {{-- Tax rate row will be added here dynamically using JS --}}
            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-default m-b-15" id="add-new-rate">
        {{ trans('tax::taxes.form.add_new_rate') }}
    </button>
</div>

@include('tax::admin.taxes.tabs.templates.rate')
@include('tax::admin.taxes.tabs.templates.state_input')
@include('tax::admin.taxes.tabs.templates.state_select')

@push('globals')
    <script>
        FleetCart.data['tax_rates'] = {!! old_json('rates', $taxClass->taxRates) !!};
        FleetCart.errors['tax_rates'] = @json($errors->get('rates.*'), JSON_FORCE_OBJECT);
    </script>
@endpush
