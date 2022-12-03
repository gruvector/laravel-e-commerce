import TaxRate from "./TaxRate";

export default class {
    constructor() {
        this.rateCount = 0;

        this.addTaxRates(FleetCart.data['tax_rates']);

        if (this.rateCount === 0) {
            this.addTaxRate();
        }

        this.addTaxRatesErrors(FleetCart.errors['tax_rates']);

        this.eventListeners();
        this.sortable();
    }

    addTaxRates(rates) {
        for (let rate of rates) {
            this.addTaxRate(rate)
        }
    }

    addTaxRate(rate = {}) {
        let textRate = new TaxRate(this.rateCount++, rate);

        $('#tax-rates').append(textRate.html());

        textRate.updateState();

        window.admin.tooltip();
    }

    addTaxRatesErrors(errors) {
        for (let key in errors) {
            let id = $.escapeSelector(key);
            let parent = $(`#${id}`).parent();

            parent.addClass('has-error');
            parent.append(`<span class="help-block">${errors[key][0]}</span>`);
        }
    }

    eventListeners() {
        $('#add-new-rate').on('click', () => this.addTaxRate());
    }

    sortable() {
        Sortable.create(document.getElementById('tax-rates'), {
            handle: '.drag-icon',
            animation: 150,
        });
    }
}
