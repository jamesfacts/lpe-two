// https://tailwindcss.com/docs/configuration
module.exports = {
  content: ["./index.php", "./app/**/*.php", "./resources/**/*.{php,vue,js}"],
  theme: {
    extend: {
      colors: {
        tahini: { 
          500: '#d4a45e',
          700: '#a16b00'
        },
        sunshine: {
          400: '#ffc107',
          500: '#ffbf00'
        },
        beige: {
          200: '#faf6f1'
        },
      }, // Extend Tailwind's default colors
      fontFamily: {
        rubik: ['Rubik', 'sans-serif'],
        necto: ['Necto Mono', 'monospace'],
        tiempos: ['Tiempos Headline', 'serif'],
      },
      spacing: {
        '18': '4.5rem',
        '100': '24rem',
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
  plugins: [
    require('@tailwindcss/typography'),
  ],
};
