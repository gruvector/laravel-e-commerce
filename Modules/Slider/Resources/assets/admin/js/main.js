import Slider from './Slider';

new Slider();

$('#autoplay').on('change', (e) => {
    $('.autoplay-speed-field').toggleClass('hide');
});

window.admin.removeSubmitButtonOffsetOn('#slides');
