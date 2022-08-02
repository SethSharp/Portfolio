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
                rectUp: 'rectUp 10s alternate infinite',
                rectDown: 'rectDown 14s linear infinite',
            }, flex: {
                'cus': '1 1 auto'
            },
            // that is actual animation
            keyframes: theme => ({
                fadeOut: {
                    '0%': { border: "2px solid transparent" },
                    '100%': { border: "2px solid black" },
                }, rectUp: {
                    '0%': {
                        marginLeft: "20px"
                    }, '50%': {
                        marginLeft: "65px",
                        marginTop: "80px"
                    }, '100%': {
                        marginLeft: "85px",
                        marginTop: "40px"
                    }
                }, rectDown: {
                    '0%': {
                        marginLeft: "80px"
                    }, '25%': {
                        marginLeft: "20px",
                        marginTop: "60px",
                        width: "5rem"
                    },'50%': {
                        marginLeft: "-40px",
                        marginTop: "120px",
                        width: "10rem"
                    }, '75%': {
                        marginLeft: "-100px",
                        marginTop: "180px",
                        width: "15rem"
                    }, '100%': {
                        marginLeft: "-160px",
                        marginTop: "240px"
                    }
                }
            }),
        },
    },
    plugins: [],
};
