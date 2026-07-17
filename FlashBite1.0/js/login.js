
const formulario = document.getElementById("formLogin");

const correo = document.getElementById("correo");

const password = document.getElementById("password");

const mensajeError = document.getElementById("mensajeError");

formulario.addEventListener("submit", function(evento){

    mensajeError.textContent = "";

    mensajeError.style.color = "red";

    if(correo.value.trim() === "" || password.value.trim() === ""){

        mensajeError.textContent = "Por favor complete todos los campos.";

        return;

    }

    if(!correo.value.includes("@")){

        mensajeError.textContent = "Ingrese un correo válido.";

        return;

    }

});

const parametros = new URLSearchParams(window.location.search);

if(parametros.get("error")){

    const mensaje = document.getElementById("mensajeError");

    mensaje.style.color = "red";
    mensaje.textContent = "Correo o contraseña incorrectos.";

}