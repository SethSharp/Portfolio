const defaultTheme = require("tailwindcss/defaultTheme");
import colors from "tailwindcss/colors.js";

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.jsx",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
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
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
