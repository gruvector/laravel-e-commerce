import Slide from './Slide';

export default class {
    constructor() {
        this.slideCount = 0;

        this.addSlides(FleetCart.data['slider.slides']);

        if (this.slideCount === 0) {
            this.addSlide();
        }

        this.attachEventListeners();
        this.makeSlidesSortable();
    }

    addSlides(slides) {
        for (let attributes of slides) {
            this.addSlide(attributes);
        }
    }

    addSlide(attributes = {}) {
        let slide = new Slide({ slideNumber: this.slideCount++, slide: attributes });

        $('#slides-wrapper').append(slide.render());
    }

    attachEventListeners() {
        $('.add-slide').on('click', () => {
            this.addSlide();
        });

        this.attachImagePickerEventListener();
    }

    attachImagePickerEventListener() {
        $('#slides-wrapper').on('click', '.slide-image', (e) => {
            let picker = new MediaPicker({ type: 'image' });

            picker.on('select', (file) => {
                let html = `
                    <img src="${file.path}">
                    <input type="hidden" name="slides[${e.currentTarget.dataset.slideNumber}][file_id]" value="${file.id}">
                `;

                $(e.currentTarget).html(html);
            });
        });
    }

    makeSlidesSortable() {
        Sortable.create(document.getElementById('slides-wrapper'), {
            handle: '.slide-drag',
            animation: 150,
        });
    }
}
