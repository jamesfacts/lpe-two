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
        conference: {
          200: '#eeefff'
        },
        beige: {
          200: '#faf6f1'
        },
        sand: {
          400: 'hsl(45deg 100% 65% / 20%)',
        },
      }, // Extend Tailwind's default colors
      fontFamily: {
        rubik: ['Rubik', 'sans-serif'],
        necto: ['Necto Mono', 'monospace'],
        tiempos: ['Tiempos Headline', 'serif'],
      },
      spacing: {
        '18': '4.5rem',
        '90': '22rem',
        '100': '24rem',
        '108': '26rem',
        '120': '29rem',
        '150': '36rem',
        '168': '42rem',
        '200': '50rem',
        '300': '75rem',
      },
      maxWidth: {
        '1400': '1400px',
      },
      fontSize: {
        '2.5xl': '1.65rem', 
        '4.5xl': '2.625rem', 
        '7xl': '5rem',
        '8xl': '5.125rem', //really 8.2xl
        '10xl': '6.3rem', 
      },
      lineHeight: {
        '11': '2.75rem',
        '12': '3rem',
        '13': '3.25rem',
        '14': '3.5rem',
        '16': '4rem',
        '18': '4.5rem',
        '20': '5rem',
        '23': '5.5rem',
        '25': '6.1rem', 
      },
      letterSpacing: {
        'lil-tight' : '-0.0125em',
        'lil-wide' : '.0125em',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('tailwindcss-debug-screens'),
  ],
};
