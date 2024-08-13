/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "selector",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    default: "#7e9ae7",
                    hover: "#2980b9",
                },
                secondary: "#0e3295",
                background: "#03060c",
                "light-bg": "#bdc3c7",
                text: "#eaedf6",
                "dark-text": "#000",
                accent: "#1855fb",
                "shadow-border": "#95a5a6",
            },
            borderRadius: {
                5: "5px",
            },
            fontFamily: {
                Mandali: ["Mandali", "sans-serif"],
                Shantell: ["Shantell Sans", "sans-serif"],
            },
            gridTemplateColumns: {
                card: "80px auto",
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
