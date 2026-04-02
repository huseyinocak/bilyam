import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                bilya: {
                    blue: '#1e66f5',
                    navy: '#0f172a',
                    mist: '#e2e8f0',
                },
            },
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                soft: '0 24px 80px -32px rgba(15, 23, 42, 0.35)',
            },
        },
    },

    plugins: [forms],
};
