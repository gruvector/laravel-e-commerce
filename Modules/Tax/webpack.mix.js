let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js(`${__dirname}/Resources/assets/admin/js/main.js`, `${__dirname}/Assets/admin/js/tax.js`)
    .sass(`${__dirname}/Resources/assets/admin/sass/main.scss`, `${__dirname}/Assets/admin/css/tax.css`)
    .then(() => {
        execSync(`npm run rtlcss ${__dirname}/Assets/admin/css/tax.css ${__dirname}/Assets/admin/css/tax.rtl.css`);
    });
