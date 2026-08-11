import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                // Display: Outfit — geometric sans dengan kepribadian
                display: ["Outfit", ...defaultTheme.fontFamily.sans],
                // Body: Lora — serif humanis untuk teks panjang
                serif: ["Lora", ...defaultTheme.fontFamily.serif],
                // UI: Outfit juga untuk interface
                sans: ["Outfit", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Token sistem SMAS St. Petrus
                // Diturunkan dari: warna keagamaan Katolik (biru & emas liturgi),
                // bukan dari template AI manapun

                // Petrine Blue — biru tua kepercayaan & tradisi, bukan biru Bootstrap
                cobalt: {
                    50:  "#EDF1F8",
                    100: "#D4DCF0",
                    200: "#A9B9E0",
                    300: "#7A95CE",
                    400: "#4E72BD",
                    500: "#2B52A3",
                    600: "#1A3A6C", // PRIMARY — biru institusional
                    700: "#142D54",
                    800: "#0E1F3C",
                    900: "#071224",
                },
                // Liturgical Gold — emas buku teks & altar, bukan kuning Tailwind
                gold: {
                    50:  "#FBF6E9",
                    100: "#F5EAC8",
                    200: "#EBD492",
                    300: "#E1BD5C",
                    400: "#D4A72C",
                    500: "#C9A227", // PRIMARY — emas liturgi
                    600: "#A07D1A",
                    700: "#775B12",
                    800: "#4F3C0C",
                    900: "#271E06",
                },
                // Slate — abu biru dingin untuk background panel
                slate: {
                    50:  "#F3F5F8",
                    100: "#E8ECF0", // surface
                    200: "#CDD4DC",
                    300: "#B0BBC7",
                    400: "#8A98A8",
                    500: "#647688",
                    600: "#4D5D6D",
                    700: "#374452",
                    800: "#232D38",
                    900: "#10161D",
                },
                // Ink — teks utama, hampir hitam dengan undertone biru
                ink: "#1C1F26",
                // Parchment — background halaman publik, sedikit hangat
                parchment: "#F8F6F1",
                // Ember — aksen darurat/highlight, merah bata tua (bukan vermilion)
                ember: "#B33A1A",
            },
            spacing: {
                // Unit rhythm 8px
                18: "4.5rem",
                22: "5.5rem",
            },
            borderWidth: {
                3: "3px",
            },
            fontSize: {
                // Skala display yang lebih ekspresif
                "display-2xl": ["4.5rem",  { lineHeight: "1.1", letterSpacing: "-0.02em" }],
                "display-xl":  ["3.75rem", { lineHeight: "1.1", letterSpacing: "-0.02em" }],
                "display-lg":  ["3rem",    { lineHeight: "1.15", letterSpacing: "-0.015em" }],
                "display-md":  ["2.25rem", { lineHeight: "1.2", letterSpacing: "-0.01em" }],
                "display-sm":  ["1.875rem",{ lineHeight: "1.25" }],
            },
            boxShadow: {
                // Shadow yang lebih subtle, dengan undertone biru cobalt
                "card":   "0 1px 3px 0 rgba(26, 58, 108, 0.08), 0 1px 2px -1px rgba(26, 58, 108, 0.06)",
                "card-md":"0 4px 12px 0 rgba(26, 58, 108, 0.10), 0 2px 4px -2px rgba(26, 58, 108, 0.06)",
                "card-lg":"0 10px 30px 0 rgba(26, 58, 108, 0.12), 0 4px 8px -4px rgba(26, 58, 108, 0.08)",
            },
            keyframes: {
                "slide-up": {
                    "0%":   { opacity: "0", transform: "translateY(16px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                "fade-in": {
                    "0%":   { opacity: "0" },
                    "100%": { opacity: "1" },
                },
                "mark-draw": {
                    "0%":   { width: "0%" },
                    "100%": { width: "100%" },
                },
            },
            animation: {
                "slide-up":  "slide-up 0.5s cubic-bezier(0.22, 1, 0.36, 1) both",
                "fade-in":   "fade-in 0.4s ease both",
                "mark-draw": "mark-draw 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.3s both",
            },
        },
    },

    plugins: [forms],
};
