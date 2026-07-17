
console.log("Registro.js cargado correctamente");

const formularioRegistro = document.getElementById("formRegistro");

const nombre = document.getElementById("nombre");
const correo = document.getElementById("correo");
const telefono = document.getElementById("telefono");

telefono.addEventListener("input", function () {

    this.value = this.value.replace(/[^0-9]/g, "");

    if(this.value.length > 9){

        this.value = this.value.substring(0,9);

    }

});

const password = document.getElementById("password");
const confirmar = document.getElementById("confirmar");

const metodoPago = document.getElementById("metodoPago");
const cuentaPago = document.getElementById("cuentaPago");

const mensajeRegistro = document.getElementById("mensajeRegistro");

const contadorNombre = document.getElementById("contadorNombre");
const seguridadPassword = document.getElementById("seguridadPassword");

nombre.addEventListener("input", function () {

    contadorNombre.textContent = nombre.value.length + "/40 caracteres";

});

password.addEventListener("input", function () {

    if (password.value.length < 6) {

        seguridadPassword.textContent = "Seguridad: Baja";
        seguridadPassword.style.color = "red";

    }

    else if (password.value.length < 10) {

        seguridadPassword.textContent = "Seguridad: Media";
        seguridadPassword.style.color = "orange";

    }

    else {

        seguridadPassword.textContent = "Seguridad: Alta";
        seguridadPassword.style.color = "green";

    }

});
metodoPago.addEventListener("change", function () {

    cuentaPago.value = "";

    cuentaPago.placeholder = "Ingrese su " + metodoPago.value;

});

cuentaPago.addEventListener("input", function () {

    if(metodoPago.value=="Yape" || metodoPago.value=="Plin"){

        this.value = this.value.replace(/[^0-9]/g,"");

        if(this.value.length>9){

            this.value=this.value.substring(0,9);

        }

    }

    if(metodoPago.value=="Visa" || metodoPago.value=="Mastercard"){

        this.value=this.value.replace(/[^0-9]/g,"");

        if(this.value.length>16){

            this.value=this.value.substring(0,16);

        }

    }

});

formularioRegistro.addEventListener("submit", function (evento) {

    evento.preventDefault();
    console.log("Se presionó Registrarse");

    mensajeRegistro.textContent = "";
    mensajeRegistro.style.color = "red";

    if (

        nombre.value.trim() === "" ||

        correo.value.trim() === "" ||

        telefono.value.trim() === "" ||

        password.value.trim() === "" ||

        confirmar.value.trim() === "" ||

        metodoPago.value === ""

    ) {

        mensajeRegistro.textContent = "Complete todos los campos.";

        return;

    }

    if (nombre.value.length < 3) {

        mensajeRegistro.textContent = "Ingrese un nombre válido.";

        return;

    }

    if (!correo.value.includes("@")) {

    mensajeRegistro.textContent = "Correo inválido.";

    return;

    }

    if(!/^\d{9}$/.test(telefono.value)){

    mensajeRegistro.textContent = "El teléfono debe tener exactamente 9 dígitos.";

    return;

    }

    if (password.value.length < 6) {

        mensajeRegistro.textContent = "La contraseña debe tener al menos 6 caracteres.";

        return;

    }

    if (password.value !== confirmar.value) {

        mensajeRegistro.textContent = "Las contraseñas no coinciden.";

        return;

    }

    if(!/^\d{9}$/.test(telefono.value)){

    mensajeRegistro.textContent="El teléfono debe tener exactamente 9 dígitos.";

    return;

}

if((metodoPago.value=="Yape" || metodoPago.value=="Plin") && !/^\d{9}$/.test(cuentaPago.value)){

    mensajeRegistro.textContent="Yape o Plin deben tener 9 dígitos.";

    return;

}

if((metodoPago.value=="Visa" || metodoPago.value=="Mastercard") && !/^\d{16}$/.test(cuentaPago.value)){

    mensajeRegistro.textContent="La tarjeta debe tener 16 dígitos.";

    return;

}

// Enviar los datos al PHP sin cambiar de página
fetch("php/registrar_usuario.php", {
    method: "POST",
    body: new FormData(formularioRegistro)
})
.then(response => response.json())
.then(data => {

    console.log(data); // <-- Déjalo para ver la respuesta

    mensajeRegistro.style.color = data.ok ? "green" : "red";
    mensajeRegistro.textContent = data.mensaje;

    if (data.ok) {

        // Espera 3 segundos para que el usuario lea el mensaje
        setTimeout(() => {
            window.location.href = "login.html";
        }, 3000);

    }

})
.catch(error => {

    console.error(error);

    mensajeRegistro.style.color = "red";
    mensajeRegistro.textContent = "Ocurrió un error al conectar con el servidor.";

});
});