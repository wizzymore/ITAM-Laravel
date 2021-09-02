const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    purge: ["./app/**/*.php", "./resources/**/*.blade.php"],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        opacity: ["disabled"],
    },
    plugins: [require("@tailwindcss/forms")],
};
