const defaultTheme = require('tailwindcss/defaultTheme')
import colors from 'tailwindcss/colors.js'

require('dotenv').config()

let primary, secondary
if (process.env.EB_ENVIRONMENT === 'seth') {
    primary = buildPrimaryColour(colors.yellow)
    secondary = buildPrimaryColour(colors.blue)
} else {
    primary = buildPrimaryColour(colors.purple)
    secondary = buildPrimaryColour(colors.gray)
}

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

        'md:grid-cols-3',
        'md:grid-cols-4',
        'md:grid-cols-5',
        'md:grid-cols-6',

        'max-w-sm',
        'max-w-md',
        'max-w-lg',
        'max-w-xl',
        'max-w-2xl',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: primary,
                secondary: secondary,
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
}

function buildPrimaryColour(colour) {
    return {
        50: colour[50],
        100: colour[100],
        200: colour[200],
        300: colour[300],
        400: colour[400],
        500: colour[500],
        600: colour[600],
        700: colour[700],
        800: colour[800],
        900: colour[900],
    }
}
