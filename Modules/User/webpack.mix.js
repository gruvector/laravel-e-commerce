let mix = require('laravel-mix');
let execSync = require('child_process').execSync;

mix.js(`${__dirname}/Resources/assets/admin/js/main.js`, `${__dirname}/Assets/admin/js/user.js`)
    .js(`${__dirname}/Resources/assets/admin/js/login.js`, `${__dirname}/Assets/admin/js/login.js`)
    .sass(`${__dirname}/Resources/assets/admin/sass/login.scss`, `${__dirname}/Assets/admin/css/login.css`)
    .sass(`${__dirname}/Resources/assets/admin/sass/main.scss`, `${__dirname}/Assets/admin/css/user.css`)
    .then(() => {
        execSync(`npm run rtlcss ${__dirname}/Assets/admin/css/login.css ${__dirname}/Assets/admin/css/login.rtl.css`);
        execSync(`npm run rtlcss ${__dirname}/Assets/admin/css/user.css ${__dirname}/Assets/admin/css/user.rtl.css`);
    });
