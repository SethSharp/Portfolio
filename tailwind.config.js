const defaultTheme = require('tailwindcss/defaultTheme')
import colors from 'tailwindcss/colors.js'

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    safelist: [
        'grid-cols-1',
        'grid-cols-2',
        'grid-cols-3',
        'grid-cols-4',
        'grid-cols-5',
        'grid-cols-6',

        //md
        'md:grid-cols-3',
        'md:grid-cols-4',
        'md:grid-cols-5',
        'md:grid-cols-6',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: colors.yellow[50],
                    100: colors.yellow[100],
                    200: colors.yellow[200],
                    300: colors.yellow[300],
                    400: colors.yellow[400],
                    500: colors.yellow[500],
                    600: colors.yellow[600],
                    700: colors.yellow[700],
                    800: colors.yellow[800],
                    900: colors.yellow[900],
                },
                secondary: {
                    100: colors.gray[100],
                    200: colors.gray[200],
                    300: colors.gray[300],
                    400: colors.gray[400],
                    500: colors.gray[500],
                    600: colors.gray[600],
                    700: colors.gray[700],
                    800: colors.gray[800],
                    900: colors.gray[900],
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
}
