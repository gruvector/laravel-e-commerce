export default class {
    appendHiddenInput(form, name, value) {
        $('<input>').attr({
            type: 'hidden',
            name: name ,
            value: value,
        }).appendTo(form);
    }

    appendHiddenInputs(form, name, values) {
        for (let value of values) {
            this.appendHiddenInput(form, name + '[]', value);
        }
    }

    removeErrors() {
        $('.has-error > .help-block').remove();
        $('.has-error').removeClass('has-error');
    }
}
