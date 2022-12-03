import BaseOption from './BaseOption';

export default class extends BaseOption {
    constructor() {
        super();

        let values = FleetCart.data['option.values'];

        $('#type').on('change', (e) => {
            super.changeOptionType({ type: e.currentTarget.value, values });
            super.addOptionsErrors(FleetCart.errors['option.values']);
        });

        $('#type').trigger('change');

        window.admin.removeSubmitButtonOffsetOn('#values');
    }

    addOptionRow({ valueId, value = { label: '', price: '', price_type: 'fixed' } }) {
        let template = this.getRowTemplate({ optionId: undefined, valueId, value });

        let selectValues = $('#select-values').append(template);

        super.initOptionRow(template, selectValues);
    }

    addOptionRowEventListener() {
        $('#add-new-row').on('click', () => {
            let valueId = $('#option-values .option-row').length;

            this.addOptionRow({ valueId });
        });
    }

    getOptionValuesElement() {
        return $('#option-values');
    }

    getAddNewRowButton() {
        return $('#add-new-row');
    }

    getInputFieldForErrorKey(key) {
        let keyParts = key.split('.');

        // Replace all "_" to "-".
        keyParts = keyParts.map(k => {
            return k.split('_').join('-');
        });

        return $(`#${keyParts.join('-')}`);
    }
}
