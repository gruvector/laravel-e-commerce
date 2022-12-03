import '../sass/media-picker.scss';

export default class {
    constructor(options) {
        this.options = _.merge({
            type: null,
            multiple: false,
            route: 'admin.file_manager.index',
            title: trans('media::media.file_manager.title'),
            message: trans('media::messages.image_has_been_added'),
        }, options);

        this.events = {};
        this.frame = this.getFrame();

        this.appendModalToBody();
        this.openFrame();
    }

    on(event, handler) {
        this.events[event] = handler;
    }

    getFrame() {
        let src = route(this.options.route, {
            type: this.options.type,
            multiple: this.options.multiple,
        });

        return $(`<iframe class="file-manager-iframe" frameborder="0" src="${src}"></iframe>`);
    }

    appendModalToBody() {
        if ($('.media-picker-modal').length === 1) {
            return;
        }

        $('body').append(this.getModal());
    }

    openFrame() {
        this.showModal();

        this.frame.on('load', () => {
            this.selectMedia();
        });
    }

    showModal() {
        let modal = $('.media-picker-modal').modal('show');

        this.setFrameHeight();
        this.setModalTitle(modal);
        this.setModalBody(modal);
        this.closeModalOnEsc(modal);
    }

    setFrameHeight() {
        this.frame.css('height', window.innerHeight * 0.8);
    }

    setModalTitle(modal) {
        modal.find('.modal-title').text(this.options.title);
    }

    setModalBody(modal) {
        modal.find('.modal-body').html(this.frame);
    }

    closeModalOnEsc(modal) {
        $(document).on('keydown', (e) => {
            if (e.keyCode === 27) {
                modal.modal('hide');
            }
        });

        this.frame.on('load keydown', () => {
            this.frame.contents().on('keydown', (e) => {
                if (e.keyCode === 27) {
                    modal.modal('hide');
                }
            });
        });
    }

    selectMedia() {
        this.frame.contents().find('.table').on('click', '.select-media', (e) => {
            e.preventDefault();

            this.events['select'](e.currentTarget.dataset);

            if (this.options.multiple) {
                if (this.options.message) {
                    notify('success', this.options.message, { context: this.frame.contents() });
                }
            } else {
                $('.media-picker-modal').modal('hide');
            }
        });
    }

    getModal() {
        return `
            <div class="media-picker-modal modal fade" role="dialog">
                <div class="modal-dialog clearfix">
                    <div class="modal-content col-md-10 col-sm-11 clearfix">
                        <div class="row">
                            <div class="modal-header">
                                <a type="button" class="close" data-dismiss="modal">&times;</a>
                                <h4 class="modal-title"></h4>
                            </div>

                            <div class="modal-body"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
}
