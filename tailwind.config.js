const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    daisyui: {
        themes: [
          {

            mytheme: {

                "primary": "#063777",

                "secondary": "#3F87E5",

                "text": "#071D53",

                "neutral": "#191D24",

                "base-100": "#2A303C",

                "info": "#3ABFF8",

                "success": "#36D399",

                "warning": "#FBBD23",

                "error": "#F87272",

                "highlight": "#68D391",
            },
          },
        ],
    },

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
        colors:{
            'gray':colors.gray,
        }
    },

    plugins: [
        require('@tailwindcss/forms'),
        require("daisyui"),
        require('flowbite/plugin'),
    ],
};
