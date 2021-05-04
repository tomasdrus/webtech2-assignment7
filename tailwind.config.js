const colors = require('tailwindcss/colors')

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    gray: colors.coolGray,
    extend: {
      colors: {
        orange: colors.orange,
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
