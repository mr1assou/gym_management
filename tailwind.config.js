/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}","./index.php","./users_field/**/*.{html,js,php}","./functions/**/*.{html,js,php}","./admin_field/**/*.{html,js,php}",
    "./includes/**/*.{html,js,php}","./js/**/*.{html,js,php}"
   ],
  theme: {
    screens:{
      'sm':'640px',
      'md':'900px',
      'lg':'1024px',
      'xl':'1280px',
      '2xl':'1500px',
      '3xl':'2100px',
      '4xl':'2650px',
    },
    extend: {
      colors:{
        'green':'#23BE15',
        'black':'#000000',
        'white':'#ffffff',
        'grey':'#EEEEEE',
        'blue':'#1774ED',
        'red':'#FF0000',
        'green-dark':'#008E3E',
        'red-light':'#EB1313',
        'grey-light':'#B3B5C0'
      }
    },
  },
  plugins: [],
}

