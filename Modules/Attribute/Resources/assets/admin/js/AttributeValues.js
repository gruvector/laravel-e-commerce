export default class {
    constructor() {
        this.attributeId = 0;
        this.valuesCount = 0;

        this.addOldValues(FleetCart.data['attribute.values']);

        if (this.valuesCount === 0) {
            this.addAttributeValue();
        }

        this.eventListeners();
        this.sortable();

        window.admin.removeSubmitButtonOffsetOn('#values');
    }

    addOldValues(values = {}) {
        for (let value of values) {
            this.addAttributeValue(value);
        }
    }

    addAttributeValue(value = { id: '', value: '' }) {
        let template = _.template($('#attribute-value-template').html());
        let html = template({ valueId: this.valuesCount++, value });

        $('#attribute-values').append(html);

        window.admin.tooltip();
    }

    eventListeners() {
        $('#add-new-value').on('click', () => this.addAttributeValue());

        $('#attribute-values').on('click', '.delete-row', (e) => {
            $(e.currentTarget).closest('tr').remove();
        });
    }

    sortable() {
        Sortable.create(document.getElementById('attribute-values'), {
            handle: '.drag-icon',
            animation: 150,
        });
    }
}
