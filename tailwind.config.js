const defaultTheme = require('tailwindcss/defaultTheme')
// import { preset } from '@sethsharp/lumuix/presets'

module.exports = {
    // presets: [preset],

    content: [
        './node_modules/@sethsharp/lumuix/dist/*.js',
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
                mono: ['Roboto Mono', ...defaultTheme.fontFamily.mono],
            },
            keyframes: {
                typing: {
                    '0%': { width: '0%' },
                    '100%': { width: '100%' },
                },
                blinking: {
                    '0%': { borderRightColor: 'transparent' },
                    '50%': { borderRightColor: 'white' },
                    '100%': { borderRightColor: 'transparent' },
                },
            },
            animation: {
                typing: 'typing 1s steps(30, end) forwards, blinking 1s infinite',
                reveal: 'typing 0.7s steps(50, end) forwards',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
}
