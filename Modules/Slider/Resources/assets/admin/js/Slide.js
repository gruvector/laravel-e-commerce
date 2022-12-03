export default class {
    constructor(data) {
        this.slidePanelHtml = this.getSlidePanelHtml(data);
    }

    getSlidePanelHtml(data) {
        data.slide.options = data.slide.options || this.getDefaultOptions();

        let template = _.template($('#slide-template').html());

        return $(template(data));
    }

    getDefaultOptions() {
        return { caption_1: {}, caption_2: {}, direction: 'left', call_to_action: {} };
    }

    render() {
        this.attachEventListeners();
        this.showSelectedOptionBlock();

        return this.slidePanelHtml;
    }

    attachEventListeners() {
        this.slidePanelHtml.find('.delete-slide').on('click', () => {
            this.slidePanelHtml.remove();
        });

        this.slidePanelHtml.find('.change-option-block').on('change', (e) => {
            this.slidePanelHtml.find('.slide-options').hide();
            this.slidePanelHtml.find(`.${e.currentTarget.value}`).show();
        });
    }

    showSelectedOptionBlock() {
        setTimeout(() => {
            this.slidePanelHtml.find('.change-option-block').trigger('change');
        });
    }
}
