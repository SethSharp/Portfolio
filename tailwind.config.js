/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            transitionDuration: {
                '0': '0ms',
                '2000': '2000ms',
            },
            // that is animation class
            animation: {
            fade: 'fadeOut 0.5s ease-in-out',
            },

            // that is actual animation
            keyframes: theme => ({
                fadeOut: {
                    '0%': { border: "2px solid transparent" },
                    '100%': { border: "2px solid black" },
                },
            }),
        },
    },
    plugins: [],
};
