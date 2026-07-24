
const formulario = document.getElementById("formLogin");

const correo = document.getElementById("correo");

const password = document.getElementById("password");

const verPassword = document.getElementById("verPassword");

const iconoPassword = document.getElementById("iconoPassword");

const mensajeError = document.getElementById("mensajeError");

formulario.addEventListener("submit", function(evento){

    mensajeError.textContent = "";

    mensajeError.style.color = "red";

    if(correo.value.trim() === "" || password.value.trim() === ""){

        mensajeError.textContent = "Por favor complete todos los campos.";

        return;

    }

    const correoValido = /^[A-Za-z0-9]+(\.[A-Za-z0-9]+)*@(gmail|hotmail|outlook|icloud|yahoo)\.com$/;

    if(!correoValido.test(correo.value.trim())){

        mensajeError.textContent = "Ingrese un correo electrónico válido.";

        evento.preventDefault();

        return;

    }

});

const parametros = new URLSearchParams(window.location.search);

if(parametros.get("error")){

    const mensaje = document.getElementById("mensajeError");

    mensaje.style.color = "red";
    mensaje.textContent = "Correo o contraseña incorrectos.";

}

verPassword.addEventListener("click", function(){

    if(password.type=="password"){

        password.type="text";

        iconoPassword.innerHTML=`
        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19C5 19 1 12 1 12a21.8 21.8 0 0 1 5.06-5.94"/>
        <path d="M9.9 4.24A10.94 10.94 0 0 1 12 5c7 0 11 7 11 7a21.9 21.9 0 0 1-3.17 4.19"/>
        <line x1="1" y1="1" x2="23" y2="23"/>
        `;

    }else{

        password.type="password";

        iconoPassword.innerHTML=`
        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
        <circle cx="12" cy="12" r="3"/>
        `;

    }

});