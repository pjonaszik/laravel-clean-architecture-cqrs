import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.{js,ts,jsx,tsx,vue}',
        './node_modules/konsta/dist/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                display: 'Oswald, ui-serif', // Adds a new `font-display` class
            }
        },
    },
    plugins: [],
};
