import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'abu-body': '#F2F2F8',
                'merah-primary': '#9C1F14',
                'merah-secondary': '#6F0707',
                'merah-warning': '#E50000',
                'merah-warning': '#E50000',
                'merah-component': '#D30808',
                'kuning-warning': '#F6C23A',
                'hijau-warning': '#55BF53',
                'abu-text': '#676767',
                'abu-component': '#A6A6A6',
                'abu-label': '#535353',
                'biru': '#76CEFF',
            }
        },
    },

    plugins: [forms],
};
