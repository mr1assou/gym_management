/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}","./users_field/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors:{
        'green':'#74f814',
        'black':'#000000',
        'white':'#ffffff',
        'grey':'#EEEEEE'
      }
    },
  },
  plugins: [],
}

