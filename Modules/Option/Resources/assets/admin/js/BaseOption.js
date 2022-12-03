export default class {
    addOptionsErrors(errors) {
        for (let key in errors) {
            let inputField = this.getInputFieldForErrorKey(key);

            inputField.closest('.option').addClass('option-has-errors');

            let parent = inputField.parent();

            parent.append(`<span class="help-block">${errors[key][0]}</span>`);
        }
    }

    getRowTemplate(data) {
        let template = _.template($('#option-select-values-template').html());

        return $(template(data));
    }

    changeOptionType({ optionId, type, values = [] }) {
        let optionValuesElement = this.getOptionValuesElement(optionId);
        let templateType = this.getTemplateType(type, optionValuesElement);
        let optionValuesData = { optionId, value: { id: '', label: '', price: '', price_type: 'fixed' } };

        if (this.shouldNotChangeTemplate(templateType, optionValuesElement)) {
            return;
        }

        if (values.length !== 0 && templateType === 'text') {
            optionValuesData.value = values[0];
        }

        let template = _.template($(`#option-${templateType}-template`).html());

        optionValuesElement.html(template(optionValuesData));

        if (templateType === 'select') {
            this.addOptionRowEventListener(optionId);

            this.addOptionRows({ optionId, values });

            if (values.length === 0) {
                this.getAddNewRowButton(optionId).trigger('click');
            }
        }
    }

    addOptionRows({ optionId, values }) {
        for (let [index, value] of values.entries()) {
            this.addOptionRow({
                optionId,
                valueId: index,
                value,
            });
        }
    }

    getTemplateType(type) {
        if (this.templateTypeIsText(type)) {
            return 'text';
        }

        if (this.templateTypeIsSelect(type)) {
            return 'select';
        }
    }

    templateTypeIsText(type) {
        return ['field', 'textarea', 'date', 'date_time', 'time'].includes(type);
    }

    templateTypeIsSelect(type) {
        return ['dropdown', 'checkbox', 'checkbox_custom', 'radio', 'radio_custom', 'multiple_select'].includes(type);
    }

    shouldNotChangeTemplate(templateType, optionValuesElement) {
        return templateType === undefined || this.alreadyHasCurrentTemplate(templateType, optionValuesElement);
    }

    alreadyHasCurrentTemplate(templateType, optionValuesElement) {
        if (templateType === 'text') {
            return optionValuesElement.children().hasClass('option-text');
        }

        if (templateType === 'select') {
            return optionValuesElement.children().hasClass('option-select');
        }
    }

    initOptionRow(template, selectValues) {
        if (selectValues.length !== 0 && ! selectValues.is('.sortable')) {
            this.makeSortable(selectValues[0]);

            selectValues.addClass('sortable');
        }

        this.deleteOptionRowEventListener(template);

        window.admin.tooltip();
    }

    deleteOptionRowEventListener(row) {
        row.find('.delete-row').on('click', (e) => {
            $(e.currentTarget).closest('.option-row').remove();
        });
    }

    makeSortable(el) {
        Sortable.create(el, {
            handle: '.drag-icon',
            animation: 150,
        });
    }
}
