import Dropzone from 'dropzone';

export default class {
    constructor() {
        Dropzone.autoDiscover = false;

        this.dropzone = new Dropzone('.dropzone', {
            url: route('admin.media.store'),
            autoProcessQueue: true,
            maxFilesize: FleetCart.maxFileSize,
        });

        this.dropzone.on('sending', this.sending);
        this.dropzone.on('success', this.success);
        this.dropzone.on('error', this.error);
    }

    sending(file, xhr) {
        xhr.timeout = 3600000;

        $('.alert-danger').remove();
    }

    success() {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            setTimeout(DataTable.reload, 1000, '#media-table .table');
        }
    }

    error(file, response) {
        $('.dz-progress').css('z-index', 1);
        $(file.previewElement).find('.dz-error-message').text(response.message);
    }
}
