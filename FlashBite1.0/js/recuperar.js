
const formulario = document.getElementById("formRecuperar");

const correo = document.getElementById("correo");
const password = document.getElementById("password");
const password2 = document.getElementById("password2");

const mensaje = document.getElementById("mensajeRecuperar");
const seguridadPassword = document.getElementById("seguridadPassword");

password.addEventListener("input", function(){

    if(password.value.length < 6){

        seguridadPassword.textContent = "Seguridad: Baja";
        seguridadPassword.style.color = "red";

    }

    else if(password.value.length < 10){

        seguridadPassword.textContent = "Seguridad: Media";
        seguridadPassword.style.color = "orange";

    }

    else{

        seguridadPassword.textContent = "Seguridad: Alta";
        seguridadPassword.style.color = "green";

    }

});


formulario.addEventListener("submit", function(evento){

    mensaje.textContent = "";
    mensaje.style.color = "red";

    if(

        correo.value.trim()==="" ||

        password.value.trim()==="" ||

        password2.value.trim()===""

    ){

        evento.preventDefault();

        mensaje.textContent="Complete todos los campos.";

        return;

    }

    if(password.value.length < 6){

        evento.preventDefault();

        mensaje.textContent="La contraseña debe tener mínimo 6 caracteres.";

        return;

    }

    if(password.value !== password2.value){

        evento.preventDefault();

        mensaje.textContent="Las contraseñas no coinciden.";

        return;

    }

    // Si todo está correcto,
    // el formulario se enviará a recuperar_password.php

});