let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js('Modules/Media/Resources/assets/admin/js/main.js', 'Modules/Media/Assets/admin/js/media.js')
    .sass('Modules/Media/Resources/assets/admin/sass/main.scss', 'Modules/Media/Assets/admin/css/media.css')
    .then(() => {
        execSync('npm run rtlcss Modules/Media/Assets/admin/css/media.css Modules/Media/Assets/admin/css/media.rtl.css');
    });
