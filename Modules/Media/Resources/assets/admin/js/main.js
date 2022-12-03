import ImagePicker from './ImagePicker';
import MediaPicker from './MediaPicker';
import Uploader from './Uploader';

window.MediaPicker = MediaPicker;

if ($('.image-picker').length !== 0) {
    new ImagePicker();
}

if ($('.dropzone').length !== 0) {
    new Uploader();
}
