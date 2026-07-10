
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

    evento.preventDefault();

    mensaje.textContent = "";
    mensaje.style.color = "red";

    const correoGuardado = localStorage.getItem("correoUsuario");

    if(

        correo.value.trim()==="" ||

        password.value.trim()==="" ||

        password2.value.trim()===""

    ){

        mensaje.textContent="Complete todos los campos.";

        return;

    }

    if(correo.value !== correoGuardado){

        mensaje.textContent="El correo no está registrado.";

        return;

    }

    if(password.value.length < 6){

        mensaje.textContent="La contraseña debe tener mínimo 6 caracteres.";

        return;

    }

    if(password.value !== password2.value){

        mensaje.textContent="Las contraseñas no coinciden.";

        return;

    }

    localStorage.setItem("passwordUsuario",password.value);

    mensaje.style.color="green";
    mensaje.textContent="Contraseña actualizada correctamente.";


    setTimeout(function(){

        window.location.href="login.html";

    },1000);

});