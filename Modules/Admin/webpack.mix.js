let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js(`${__dirname}/Resources/assets/js/main.js`, `${__dirname}/Assets/js/admin.js`)
    .js(`${__dirname}/Resources/assets/js/dashboard.js`, `${__dirname}/Assets/js/dashboard.js`)
    .sass(`${__dirname}/Resources/assets/sass/main.scss`, `${__dirname}/Assets/css/admin.css`)
    .sass(`${__dirname}/Resources/assets/sass/dashboard.scss`, `${__dirname}/Assets/css/dashboard.css`)
    .copy(`${__dirname}/Resources/assets/images`, `${__dirname}/Assets/images`)
    .copy(`${__dirname}/node_modules/font-awesome/fonts`, `${__dirname}/Assets/fonts`)
    .copy(`${__dirname}/node_modules/bootstrap/dist/fonts`, `${__dirname}/Assets/fonts`)
    .copy(`${__dirname}/node_modules/tinymce/themes`, `${__dirname}/Assets/js/wysiwyg/themes`)
    .copy(`${__dirname}/node_modules/tinymce/skins`, `${__dirname}/Assets/js/wysiwyg/skins`);

let tinymcePlugins = [
    'lists',
    'link',
    'table',
    'image',
    'media',
    'paste',
    'autosave',
    'autolink',
    'wordcount',
    'code',
    'fullscreen',
];

tinymcePlugins.forEach(plugin => {
    mix.copy(`${__dirname}/node_modules/tinymce/plugins/${plugin}/plugin.js`, `${__dirname}/Assets/js/wysiwyg/plugins/${plugin}`);
});

mix.then(() => {
    execSync(`npm run rtlcss ${__dirname}/Assets/css/admin.css ${__dirname}/Assets/css/admin.rtl.css`);
    execSync(`npm run rtlcss ${__dirname}/Assets/css/dashboard.css ${__dirname}/Assets/css/dashboard.rtl.css`);
});
