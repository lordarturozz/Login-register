//Declaración de variables 
let contenedor_login_register = document.querySelector(".contenedor__login-register")
let formulario_login = document.querySelector(".formulario__login")
let formulario_register = document.querySelector(".formulario__register")
let caja_trasera_login = document.querySelector(".caja_trasera-login")
let caja_trasera_register = document.querySelector(".caja_trasera-register")
function register(){
    formulario_register.style.display = "block"
    contenedor_login_register.style.left = "410px"
    formulario_register.style.display = "none"
    caja_trasera_register.style.opacity = "0"
    caja_trasera_login.style.opacity = "1"
    
}