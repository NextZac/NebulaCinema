import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
const round = (num) =>
  num
    .toFixed(7)
    .replace(/(\.[0-9]+?)0+$/, "$1")
    .replace(/\.0$/, "");
const rem = (px) => `${round(px / 16)}rem`;
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "node_modules/preline/dist/*.js",
    ],

    theme: {
        extend: {
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        color: theme("colors.brand-white"),
                        maxWidth: "none",
                        h1: {
                            fontSize: rem(64, 16),
                            marginTop: "0",
                            marginBottom: rem(32, 64),
                            lineHeight: round(58 / 64),
                            fontWeight: "700",
                        },
                        h2: {
                            fontSize: rem(48, 16),
                            marginTop: "0",
                            marginBottom: rem(24, 24),
                            lineHeight: round(66 / 48),
                            fontWeight: "700",
                        },
                        h3: {
                            fontSize: rem(32, 16),
                            marginTop: "0",
                            marginBottom: rem(12, 20),
                            lineHeight: round(44 / 32),
                            fontWeight: "700",
                        },
                        h4: {
                            fontSize: rem(24, 16),
                            marginTop: rem(24, 16),
                            marginBottom: rem(8, 16),
                            lineHeight: round(32 / 24),
                            fontWeight: "700",
                        },
                        h5: {
                            fontSize: rem(20, 16),
                            marginTop: rem(24, 16),
                            marginBottom: rem(8, 16),
                            lineHeight: round(30 / 20),
                            color: theme("colors.brand-silver"),
                            fontWeight: "700",
                        },
                        p: {
                            marginTop: rem(20, 16),
                            marginBottom: rem(20, 16),
                            lineHeight: round(24 / 16),
                        },
                        a: {
                            color: theme("colors.brand"),
                            textDecoration: "none",
                            "&:hover": {
                                textDecoration: "underline",
                            },
                        },
                        ul: {
                            li: {
                                "&::marker": {
                                    color: theme("colors.brand"),
                                },
                            },
                        },
                    },
                },
            }),
            colors: {
                "brand-silver": "#ACAFB9",
                "brand-gray": "#34404B",
                "brand-dark-gray": "#222931",
                "brand-white": "#F8F7FC",
                "brand-error": "#EF4444",
                "brand-warning": "#F59E0B",
                "brand-success": "#00B67A",
                "brand-info": "#4671F6",
                "brand-50": "#eef2ff",
                "brand-100": "#e0e7ff",
                "brand-200": "#c7d2fe",
                "brand-300": "#a5b4fc",
                "brand-400": "#818cf8",
                "brand-500": "#6366f1",
                "brand-600": "#4F46E5",
                "brand-700": "#4338ca",
                "brand-800": "#3730a3",
                "brand-900": "#312e81",
                "brand-950": "#1e1b4b",
                "brand-975": "#171532",
            },
            fontFamily: {
                sans: ["Quicksand", ...defaultTheme.fontFamily.sans],
                "avenir-black": [
                    "Avenir-Black",
                    ...defaultTheme.fontFamily.sans,
                ],
                "avenir-heavy": [
                    "Avenir-Heavy",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            fontWeight: {
                medium: "600",
                bold: "700",
                black: "900",
            },
            fontSize: {
                xs: ["0.75rem", { lineHeight: "1rem" }],
                sm: ["0.875rem", { lineHeight: "1.25rem" }],
                base: ["1rem", { lineHeight: "1.5rem" }],
                lg: ["1.125rem", { lineHeight: "1.75rem" }],
                xl: ["1.25rem", { lineHeight: "1.875rem" }],
                "2xl": ["1.5rem", { lineHeight: "2rem" }],
                "3xl": ["2rem", { lineHeight: "2.75rem" }],
                "4xl": ["2.25rem", { lineHeight: "2.5rem" }],
                "5xl": ["3rem", { lineHeight: "4.125rem" }],
                "6xl": ["4rem", { lineHeight: "3.625rem" }],
                "7xl": ["4.5rem", { lineHeight: "1" }],
                "8xl": ["6rem", { lineHeight: "1" }],
                "9xl": ["8rem", { lineHeight: "1" }],
                smallest: ["0.75rem", { lineHeight: "1.5rem" }], // 12px with 24px line height
                detail: ["0.875rem", { lineHeight: "1.5rem" }], // 14px with 24px line height
                body: ["1rem", { lineHeight: "1.5rem" }], // 16px with 24px line height
                subtitle: ["1.125rem", { lineHeight: "1.5rem" }], // 18px with 24px line height
                title1: ["1.5rem", { lineHeight: "1.5rem" }], // 24px with 24px line height
                title2: ["1.625rem", { lineHeight: "1.5rem" }], // 26px with 24px line height
                main1: ["2rem", { lineHeight: "1.5rem" }], // 32px with 24px line height
                main2: ["2.375rem", { lineHeight: "1.5rem" }], // 38px with 24px line height
                main3: ["2.625rem", { lineHeight: "1.5rem" }], // 42px with 24px line height
                display1: ["3.75rem", { lineHeight: "3.5rem" }], // 60px with 24px line height
                display2: ["4.5rem", { lineHeight: "3.375rem" }], // 72px with 24px line height
                display3: ["5rem", { lineHeight: "3.375rem" }], // 80px with 24px line height
            },
            container: {
                center: true,
            },
            backgroundImage: {
                "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
            },
            borderRadius: {
                "4xl": "2rem",
            },
            boxShadow: {
                xs: "0 0 2px 0 rgb(0 0 0 / 0.05)",
                inset: "inset 0px 1px 0px #2F3E4C",
                glow: "0 0 10px #FF7301",
            },
            width: () => ({
                "1/8": "12.5%",
            }),
            spacing: {
                0.25: "1px",
                0.75: "3px",
            },
        },
    },

    plugins: [
        forms,
        require("preline/plugin"),
        function ({ addUtilities }) {
            addUtilities({
                ".scrollbar-hide": {
                    /* For Webkit browsers (Chrome, Safari) */
                    "::-webkit-scrollbar": {
                        display: "none",
                    },
                    /* For Firefox */
                    "-ms-overflow-style": "none" /* IE and Edge */,
                    "scrollbar-width": "none" /* Firefox */,
                },
            });
        },
    ],
};
