import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    presets: [
        require('./vendor/tallstackui/tallstackui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/tallstackui/tallstackui/src/**/*.php',
        'node_modules/preline/dist/*.js',
    ],

    theme: {
        extend: {
            colors: {
                primary: colors.rose,
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require("daisyui"), require('preline/plugin')],
};
