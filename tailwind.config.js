import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: "#fef2f2",
                    100: "#fee2e2",
                    500: "#dc2626",
                    600: "#c81e1e", // merah utama
                    700: "#a31515", // hover
                    900: "#5c0d0d",
                },
                cream: "#fffaf7", // putih hangat untuk latar
            },
        },
    },
    plugins: [forms],
};
