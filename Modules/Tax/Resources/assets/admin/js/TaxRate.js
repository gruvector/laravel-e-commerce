export default class {
    constructor(rateId, rate = {}) {
        this.rateId = rateId;
        this.rate = rate;
    }

    html() {
        this.html = this.template({ rateId: this.rateId, rate: this.rate });

        this.eventListeners();

        return this.html;
    }

    updateState() {
        this.html.find('.country select').trigger('change');
    }

    template(data) {
        let template = _.template($('#tax-rate-template').html());

        return $(template(data));
    }

    eventListeners(html) {
        this.html.find('.country select').on('change', (e) => {
            if (e.currentTarget.value) {
                this.changeState(e.currentTarget.value);
            }
        });

        this.html.on('click', '.delete-row', this.delete);
    }

    changeState(countryCode) {
        this.getStateField().prop('disabled', true);

        let oldState = this.getStateField().val();

        $.getJSON(route('countries.states.index', countryCode), (states) => {
            this.getStateField()
                .replaceWith(this.getStateTemplate(states))
                .prop('disabled', false);

            if (oldState) {
                this.getStateField().val(oldState);
            }
        });
    }

    getStateField() {
        let id = $.escapeSelector(`rates.${this.rateId}.state`);

        return $(`#${id}`);
    }

    getStateTemplate(states) {
        if ($.isEmptyObject(states)) {
            return this.getInputStateTemplate();
        }

        return this.getSelectStateTemplate(states);
    }

    getInputStateTemplate() {
        let template = _.template($('#state-input-template').html());

        return template({ rateId: this.rateId });
    }

    getSelectStateTemplate(states) {
        let template = _.template($('#state-select-template').html());

        return template({ rateId: this.rateId, states });
    }

    delete(e) {
        $(e.currentTarget).closest('.tax-rate').remove();
    }
}
