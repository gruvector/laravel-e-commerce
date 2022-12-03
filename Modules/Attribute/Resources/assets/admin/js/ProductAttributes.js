export default class {
    constructor() {
        this.attributeCount = 0;

        this.addProductAttributes(FleetCart.data['product.attributes']);

        if (this.attributeCount === 0) {
            this.addProductAttribute();
        }

        this.addProductAttributesErrors(FleetCart.errors['product.attributes']);

        this.eventListeners();
        this.triggerSelected();
        this.sortable();
    }

    addProductAttributes(attributes) {
        for (let attribute of attributes) {
            this.addProductAttribute(attribute);
        }
    }

    addProductAttribute(attribute = {}) {
        let template = _.template($('#product-attribute-template').html());

        let html = template({ attributeId: this.attributeCount++, attribute });

        $('#product-attributes').append(html);

        window.admin.tooltip();
        window.admin.selectize();
    }

    addProductAttributesErrors(errors) {
        for (let key in errors) {
            let id = $.escapeSelector(key);
            let parent = $(`#${id}`).parent();

            parent.addClass('has-error');
            parent.append(`<span class="help-block">${errors[key][0]}</span>`);
        }
    }

    deleteProductAttribute(e) {
        $(e.currentTarget).closest('tr').remove();
    }

    changeProductAttributeValues(attributeEl, clearSelected = true) {
        let values = $(attributeEl).find('option:selected').data('values');

        let id = $.escapeSelector(`attributes.${attributeEl.dataset.attributeId}.values`);
        let attributeValues = $(`#${id}`)[0].selectize;

        if (clearSelected) {
            attributeValues.clear();
        }

        attributeValues.clearOptions();

        let options = attributeValues.options;

        for (let id in values) {
            attributeValues.addOption({ id, name: values[id] });

            for (let i in options) {
                attributeValues.addItem(options[i].value);
            }
        }
    }

    eventListeners() {
        $('#add-new-attribute').on('click', () => this.addProductAttribute());
        $('#product-attributes').on('click', '.delete-row', this.deleteProductAttribute);
        $('#product-attributes-wrapper').on('change', '.attribute', (e) => {
            this.changeProductAttributeValues(e.currentTarget);
        });
    }

    triggerSelected() {
        $('.attribute').has('option:selected').each((i, el) => {
            this.changeProductAttributeValues(el, false);
        });
    }

    sortable() {
        Sortable.create(document.getElementById('product-attributes'), {
            handle: '.drag-icon',
            animation: 150,
        });
    }
}
