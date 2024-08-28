import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/Blocks/*.php',
    ],
    theme: {
        extend: {
            maxWidth: {
                'wide': '1200px',
            },
        },
    },
    plugins: [forms],
};
