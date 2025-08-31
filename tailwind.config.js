/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      sans: ['Cairo', 'sans-serif'],
      serif: ['Cairo', 'serif'],
      mono: ['Cairo', 'monospace'],
      display: ['Cairo', 'sans-serif'],
      body: ['Cairo', 'sans-serif'],
    },
    extend: {
    },
  },
  plugins: [],
};

