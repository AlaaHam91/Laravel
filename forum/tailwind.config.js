module.exports = {
  theme: {
    extend: {
        //added to customizeation
        colors:{
            mainColor:"#89C9C9"
        },
        fontFamily:{
            sans:["Montserrat"]
        }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
