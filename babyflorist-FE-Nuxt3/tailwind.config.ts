import type { Config } from 'tailwindcss'
import containerQueries from '@tailwindcss/container-queries'
import forms from '@tailwindcss/forms'

export default {
  darkMode: 'class',
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
  ],
  theme: {
    extend: {
      colors: {
        "primary": "#ec1313",
        "gold": "#D4AF37",
        "wine": "#722F37",
        "gold-light": "#FFD700",
        "background-light": "#f8f6f6",
        "background-dark": "#221010",
        "off-white": "#FAF9F6",
        "light-beige": "#F2EBE3",
        "primary-red": "#8B1D1D",
        "luxury-gold": "#C5A059",
        "cream-bg": "#FCF9F5",
      },
      fontFamily: {
        "display": ["Be Vietnam Pro", "sans-serif"],
        "serif": ["Playfair Display", "serif"],
      },
      maxWidth: {
        '1400': '1400px',
      },
      borderRadius: {
        "DEFAULT": "0.25rem",
        "lg": "0.5rem",
        "xl": "0.75rem",
        "full": "9999px"
      },
      keyframes: {
        'slide-in-right': {
          '0%': { transform: 'translateX(100%)' },
          '100%': { transform: 'translateX(0)' },
        }
      },
      animation: {
        'slide-in-right': 'slide-in-right 0.3s ease-out forwards',
      },
    },
  },
  plugins: [containerQueries, forms],
} satisfies Config
