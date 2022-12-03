import BaseOption from './BaseOption';

export default class extends BaseOption {
    constructor() {
        super();

        this.optionsCount = 0;

        this.addOptions(FleetCart.data['product.options']);

        if (this.optionsCount === 0) {
            this.addOption();
        }

        if (this.optionsCount > 3) {
            this.collapseOptions();
        }

        super.addOptionsErrors(FleetCart.errors['product.options']);

        $('#add-new-option').on('click', () => this.addOption());
        $('#add-global-option').on('click', () => this.addGlobalOption());
    }

    addOptions(options) {
        for (let option of options) {
            this.addOption(option);
        }
    }

    collapseOptions() {
        let options = $('.option:not(.option-has-errors)');

        for (let option of options) {
            $(option).find('[data-toggle=collapse]').trigger('click');
        }
    }

    addGlobalOption() {
        let globalOptionId = $('#global-option').val();

        if (globalOptionId === '') {
            return window.admin.stopButtonLoading($('#add-global-option'));
        }

        $.ajax({
            type: 'GET',
            url: route('admin.options.show', globalOptionId),
            dataType: 'json',
            success: option => {
                this.addOption(option);

                window.admin.stopButtonLoading($('#add-global-option'));
            },
        });
    }

    addOption(option = { id: null, name: null, type: null, is_required: false, values: [] }) {
        // Cast "is_required" field to boolean.
        option.is_required = !! JSON.parse(option.is_required);

        let optionId = this.optionsCount;

        let template = _.template($('#option-template').html());
        let html = $(template({ option, optionId }));

        if (option.name !== null) {
            setTimeout(() => {
                $(`#option-${optionId}`).find('#option-name').text(option.name);
            });
        }

        let optionGroup = $('#options-group').append(html);

        if (! optionGroup.is('.sortable')) {
            super.makeSortable(optionGroup[0]);

            optionGroup.addClass('sortable');
        }

        this.deleteOptionEventListener(html);
        this.updateOptionNameEventListener(optionId);
        this.updateTemplateEventListener(optionId, option['values']);

        window.admin.tooltip();

        this.optionsCount++;
    }

    deleteOptionEventListener(option) {
        option.find('.delete-option').on('click', (e) => $(e.currentTarget).closest('.option').remove());
    }

    updateOptionNameEventListener(optionId) {
        let option = $(`#option-${optionId}`);
        let old = option.find('#option-name').text();

        $(option).find('.option-name-field').on('input', (e) => {
            let name = e.currentTarget.value !== '' ? e.currentTarget.value : old;

            option.find('#option-name').text(name);
        });
    }

    updateTemplateEventListener(optionId, values = []) {
        let optionTypeElement = $(`#option-${optionId}-type`);

        optionTypeElement.on('change', (e) => {
            let type = e.currentTarget.value;

            if (type === '') {
                return this.getOptionValuesElement(optionId).html('');
            }

            super.changeOptionType({ optionId, type, values });
        });

        // Trigger the "change" event on option type after attaching the listener
        // this will automatically take effect of the current option which is
        // maybe loaded from the old input values or from the product data.
        optionTypeElement.trigger('change');
    }

    addOptionRow({ optionId, valueId, value = { label: '', price: '', price_type: 'fixed' } }) {
        let template = this.getRowTemplate({ optionId, valueId, value });

        let selectValues = $(`#option-${optionId}-select-values`).append(template);

        super.initOptionRow(template, selectValues);
    }

    addOptionRowEventListener(optionId) {
        $(`#option-${optionId}-add-new-row`).on('click', () => {
            let valueId = $(`#option-${optionId}-values .option-row`).length;

            this.addOptionRow({ optionId, valueId });
        });
    }

    getOptionValuesElement(optionId) {
        return $(`#option-${optionId}-values`);
    }

    getAddNewRowButton(optionId) {
        return $(`#option-${optionId}-add-new-row`);
    }

    getInputFieldForErrorKey(key) {
        let keyParts = key.split('.');

        // Remove the first element which is "option".
        keyParts.shift();

        // Replace all "_" to "-".
        keyParts = keyParts.map(k => {
            return k.split('_').join('-');
        });

        return $(`#option-${keyParts.join('-')}`);
    }
}
