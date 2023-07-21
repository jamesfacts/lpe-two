// https://tailwindcss.com/docs/configuration
module.exports = {
  content: ["./index.php", "./app/**/*.php", "./resources/**/*.{php,vue,js}"],
  theme: {
    extend: {
      colors: {
        tahini: { 
          500: '#d4a45e' 
        },
        sunshine: {
          500: '#ffbf00'
        },
      }, // Extend Tailwind's default colors
      fontFamily: {
        rubik: ['Rubik', 'sans-serif'],
        necto: ['Necto Mono', 'monospace'],
      },
      spacing: {
        '120': '29rem',
        '150': '36rem',
        '168': '42rem',
        '200': '50rem',
      },
      lineHeight: {
        '12': '3rem',
      },
      maxWidth: {
        '1400': '1400px',
      },
    },
  },
  plugins: [ ],
};
