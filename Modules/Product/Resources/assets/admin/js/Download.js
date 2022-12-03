export default class {
    constructor(download) {
        this.downloadHtml = this.getDownloadHtml(download);
    }

    getDownloadHtml(download) {
        let template = _.template($('#product-download-template').html());

        return $(template(download));
    }

    render() {
        this.attachEventListeners();

        return this.downloadHtml;
    }

    attachEventListeners() {
        this.downloadHtml.find('.delete-row').on('click', () => {
            this.downloadHtml.remove();
        });

        this.downloadHtml.find('.btn-choose-file').on('click', () => {
            let picker = new MediaPicker();

            picker.on('select', (file) => {
                this.downloadHtml.find('.download-name').val(file.filename);
                this.downloadHtml.find('.download-file').val(file.id);
            });
        });
    }
}
