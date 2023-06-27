// https://tailwindcss.com/docs/configuration
module.exports = {
  content: ["./index.php", "./app/**/*.php", "./resources/**/*.{php,vue,js}"],
  theme: {
    extend: {
      colors: {}, // Extend Tailwind's default colors
      fontFamily: {
        rubik: ['Rubik', 'sans-serif'],
      },
      spacing: {
        '168': '42rem',
      },
    },
  },
  plugins: [ ],
};
