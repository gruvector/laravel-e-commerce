import Download from './Download';

export default class {
    constructor() {
        this.downloadsCount = 0;

        this.addDownloads(FleetCart.data['product.downloads']);

        if (this.downloadsCount === 0) {
            this.addDownload();
        }

        this.attachEventListeners();
        this.makeDownloadsSortable();
    }

    addDownloads(downloads) {
        for (let attributes of downloads) {
            this.addDownload(attributes);
        }
    }

    addDownload(attributes = {}) {
        let download = new Download({ download: attributes });

        $('#downloads-wrapper').append(download.render());

        this.downloadsCount++;
        window.admin.tooltip();
    }

    attachEventListeners() {
        $('#add-new-file').on('click', () => {
            this.addDownload();
        });
    }

    makeDownloadsSortable() {
        Sortable.create(document.getElementById('downloads-wrapper'), {
            handle: '.drag-icon',
            animation: 150,
        });
    }
}
