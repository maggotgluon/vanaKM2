const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                bblue:'#0082A1',
                bgreen:'#36B553',
                borange:'#F7941D',
                byellow:'#FFDE17'
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
