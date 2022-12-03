let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js(`${__dirname}/Resources/assets/admin/js/main.js`, `${__dirname}/Assets/admin/js/translation.js`)
    .styles([
        `${__dirname}/node_modules/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css`,
    ], `${__dirname}/Assets/admin/css/translation.css`)
    .copy(`${__dirname}/node_modules/x-editable/dist/bootstrap3-editable/img`, `${__dirname}/Assets/admin/img`)
    .then(() => {
        execSync(`npm run rtlcss ${__dirname}/Assets/admin/css/translation.css ${__dirname}/Assets/admin/css/translation.rtl.css`);
    });
