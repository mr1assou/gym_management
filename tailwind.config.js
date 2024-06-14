/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}","./index.php","./users_field/**/*.{html,js,php}","./functions/**/*.{html,js,php}",
    "./includes/**/*.{html,js,php}","./js/**/*.{html,js,php}"
   ],
  theme: {
    extend: {
      colors:{
        'green':'#74f814',
        'black':'#000000',
        'white':'#ffffff',
        'grey':'#EEEEEE',
        'blue':'#1774ED',
        'red':'#FF0000',
        'green-dark':'#008E3E',
        'red-light':'#EB1313'
      }
    },
  },
  plugins: [],
}

