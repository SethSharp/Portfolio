/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            screens: {
                "custom1": "845px",
                "custom2": "960px",
                "custom3": "979px"
            },
            transitionDuration: {
                '0': '0ms',
                '2000': '2000ms',
            },
            // that is animation class
            animation: {
                fade: 'fadeOut 0.3s ease-in-out',
                rectUpFast: 'ru 4s linear infinite',
                rectUpMed: 'ru 6s linear infinite',
                rectUpSlow: 'ru 10s linear infinite',
                rectDownFast: 'rd 4s linear infinite',
                rectDownSlow: 'rd 8s linear infinite',
            }, flex: {
                'cus': '1 1 auto'
            },
            // that is actual animation
            keyframes: theme => ({
                fadeOut: {
                    '0%': { border: "2px solid transparent" },
                    '100%': { border: "2px solid black" },
                }, ru: {
                    '0%': {
                        transform: "translateX(0px)",
                        transform: "translateY(0px)"
                    }, '100%': {
                        transform: "translate(800px, -950px)"
                    }
                }, rd: {
                    '0%': {
                        transform: "translate(100px, -100px)"
                    }, '100%': {
                        transform: "translate(-500px,600px)"
                    }
                }
            }),
        },
    },
    plugins: [],
};
