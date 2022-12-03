let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js(`${__dirname}/Resources/assets/admin/js/main.js`, `${__dirname}/Assets/admin/js/report.js`)
    .sass(`${__dirname}/Resources/assets/admin/scss/main.scss`, `${__dirname}/Assets/admin/css/report.css`)
    .then(() => {
        execSync(`npm run rtlcss ${__dirname}/Assets/admin/css/report.css ${__dirname}/Assets/admin/css/report.rtl.css`);
    });
