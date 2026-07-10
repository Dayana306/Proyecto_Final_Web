
const formularioRegistro = document.getElementById("formRegistro");

const nombre = document.getElementById("nombre");
const correo = document.getElementById("correo");
const telefono = document.getElementById("telefono");

const password = document.getElementById("password");
const confirmar = document.getElementById("confirmar");

const metodoPago = document.getElementById("metodoPago");
const cuentaPago = document.getElementById("cuentaPago");

const mensajeRegistro = document.getElementById("mensajeRegistro");

const contadorNombre = document.getElementById("contadorNombre");
const seguridadPassword = document.getElementById("seguridadPassword");

nombre.addEventListener("input", function(){

    contadorNombre.textContent = nombre.value.length + "/40 caracteres";

});

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
metodoPago.addEventListener("change", function(){

    cuentaPago.placeholder = "Ingrese su " + metodoPago.value;

});

formularioRegistro.addEventListener("submit", function(evento){

    mensajeRegistro.textContent = "";
    mensajeRegistro.style.color = "red";

    if(

        nombre.value.trim()==="" ||

        correo.value.trim()==="" ||

        telefono.value.trim()==="" ||

        password.value.trim()==="" ||

        confirmar.value.trim()==="" ||

        metodoPago.value===""

    ){

        mensajeRegistro.textContent="Complete todos los campos.";

        return;

    }

    if(nombre.value.length < 3){

        mensajeRegistro.textContent="Ingrese un nombre válido.";

        return;

    }
    if(!correo.value.includes("@")){

        mensajeRegistro.textContent="Correo inválido.";

        return;

    }
    if(password.value.length < 6){

        mensajeRegistro.textContent="La contraseña debe tener al menos 6 caracteres.";

        return;

    }

    if(password.value !== confirmar.value){

        mensajeRegistro.textContent="Las contraseñas no coinciden.";

        return;

    }

    mensajeRegistro.style.color="green";

    mensajeRegistro.textContent="Usuario registrado correctamente.";

    console.log("Nombre:", localStorage.getItem("nombreUsuario"));
    console.log("Correo:", localStorage.getItem("correoUsuario"));
    console.log("Contraseña:", localStorage.getItem("passwordUsuario"));


});