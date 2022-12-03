let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js(`${__dirname}/Resources/assets/admin/js/main.js`, `${__dirname}/Assets/admin/js/order.js`)
    .sass(`${__dirname}/Resources/assets/admin/sass/main.scss`, `${__dirname}/Assets/admin/css/order.css`)
    .sass(`${__dirname}/Resources/assets/admin/sass/print.scss`, `${__dirname}/Assets/admin/css/print.css`)
    .then(() => {
        execSync(`npm run rtlcss ${__dirname}/Assets/admin/css/order.css ${__dirname}/Assets/admin/css/order.rtl.css`);
        execSync(`npm run rtlcss ${__dirname}/Assets/admin/css/print.css ${__dirname}/Assets/admin/css/print.rtl.css`);
    });
