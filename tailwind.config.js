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
                sans: ['"Plus Jakarta Sans"', 'Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', 'Georgia', 'serif'],
            },
            colors: {
                forest: '#152E1B',
                'dark-green': '#214328',
                sage: '#76A77A',
                'sage-soft': '#EAF3EB',
                cream: '#FAF7F2',
                'cream-pure': '#FFFFFF',
                sand: '#EFE8DE',
                'warm-brown': '#8D6841',
                'warm-brown-light': '#F6F0E7',
            },
            transitionTimingFunction: {
                luxury: 'cubic-bezier(0.32, 0.72, 0, 1)',
                snappy: 'cubic-bezier(0.16, 1, 0.3, 1)',
            },
            boxShadow: {
                'ambient-sm': '0 2px 10px rgba(21, 46, 27, 0.04)',
                'ambient': '0 12px 35px -8px rgba(21, 46, 27, 0.06), 0 4px 12px -2px rgba(21, 46, 27, 0.03)',
                'ambient-lg': '0 25px 60px -15px rgba(21, 46, 27, 0.10), 0 10px 20px -5px rgba(21, 46, 27, 0.04)',
                'bezel-inner': 'inset 0 1px 1px 0 rgba(255, 255, 255, 0.85)',
            },
            borderRadius: {
                '4xl': '2rem',
                '5xl': '2.5rem',
            },
        },
    },

    plugins: [forms],
};
