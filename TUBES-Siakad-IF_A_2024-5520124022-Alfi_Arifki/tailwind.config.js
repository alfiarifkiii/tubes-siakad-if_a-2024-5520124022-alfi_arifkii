import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'amalfi-tile': '#2E5AA7',
                'sea-breeze': '#86C5FF',
                'citrus-zest': '#FFA62B',
                'cream-gelato': '#F8E6A0',
            }
        },
    },

    plugins: [forms],
};