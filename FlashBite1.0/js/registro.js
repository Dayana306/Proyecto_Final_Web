
console.log("Registro.js cargado correctamente");

const formularioRegistro = document.getElementById("formRegistro");

const nombre = document.getElementById("nombre");
const correo = document.getElementById("correo");
const telefono = document.getElementById("telefono");


telefono.addEventListener("input", function () {

    // Solo números
    this.value = this.value.replace(/[^0-9]/g, "");

    // Máximo 9 dígitos
    if(this.value.length > 9){
        this.value = this.value.substring(0,9);
    }

    // Debe empezar con 9
    if(this.value.length >= 1 && this.value.charAt(0)!="9"){
        this.value="";
    }

    // Mensajes de ayuda
    if(this.value.length==0){

        ayudaTelefono.innerHTML="Ejemplo: 987654321";
        ayudaTelefono.style.color="gray";

    }
    else if(this.value.length<9){

        ayudaTelefono.innerHTML="Faltan " + (9-this.value.length) + " dígitos";
        ayudaTelefono.style.color="orange";

    }
    else{

        ayudaTelefono.innerHTML="✔ Número válido";
        ayudaTelefono.style.color="green";

    }

});


const password = document.getElementById("password");
const confirmar = document.getElementById("confirmar");
const verPassword = document.getElementById("verPassword");
const verConfirmar = document.getElementById("verConfirmar");
const iconoPassword = document.getElementById("iconoPassword");
const iconoConfirmar = document.getElementById("iconoConfirmar");


const metodoPago = document.getElementById("metodoPago");
const cuentaPago = document.getElementById("cuentaPago");

const mensajeRegistro = document.getElementById("mensajeRegistro");

const contadorNombre = document.getElementById("contadorNombre");
const seguridadPassword = document.getElementById("seguridadPassword");
const mensajeConfirmar = document.getElementById("mensajeConfirmar");
const ayudaNombre = document.getElementById("ayudaNombre");
const ayudaCorreo = document.getElementById("ayudaCorreo");
const ayudaTelefono = document.getElementById("ayudaTelefono");
const ayudaPago = document.getElementById("ayudaPago");


nombre.addEventListener("input", function () {
    // Solo letras y espacios
    this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g, "");
    // Evita espacios dobles
    this.value = this.value.replace(/\s{2,}/g, " ");
    // Primera letra de cada palabra en mayúscula
    this.value = this.value.replace(/\b\w/g,function(letra){
        return letra.toUpperCase();
    });
    contadorNombre.textContent = this.value.length + "/40 caracteres";

    if(this.value.length==0){

        ayudaNombre.textContent="";
    }

    else if(this.value.length<3){

        ayudaNombre.textContent="Debe escribir al menos un nombre y un apellido.";
        ayudaNombre.style.color="orangered";
    }

    else if(!/^[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,}( [A-Za-zÁÉÍÓÚáéíóúÑñ]{2,})+$/.test(this.value)){

        ayudaNombre.textContent="Ejemplo: Juan Pérez";
        ayudaNombre.style.color="orange";
    }

    const palabras = this.value.trim().split(" ");

    let invalido = false;

    for(const palabra of palabras){

        if(/([A-Za-zÁÉÍÓÚáéíóúÑñ])\1+/i.test(palabra)){
            invalido = true;
            break;
        }

    }

    if(invalido){

        ayudaNombre.textContent = "No se permiten letras repetidas.";
        ayudaNombre.style.color = "red";
        return;

    }

    else{

        ayudaNombre.textContent="✔ Nombre correcto";
        ayudaNombre.style.color="green";
    }
});


correo.addEventListener("input", function(){

    const valor = this.value.trim();

    if(valor==""){

        ayudaCorreo.textContent="";
        return;

    }

    if(!valor.includes("@")){

        ayudaCorreo.textContent="Falta el símbolo @";
        ayudaCorreo.style.color="orangered";
        return;

    }

    if(!valor.includes(".")){

        ayudaCorreo.textContent="Falta el dominio (.com)";
        ayudaCorreo.style.color="orange";
        return;

    }

    const correoValido=/^[A-Za-z0-9]+(\.[A-Za-z0-9]+)*@(gmail|hotmail|outlook|icloud|yahoo)\.com$/;

    if(correoValido.test(valor)){

        ayudaCorreo.textContent="✔ Correo válido";
        ayudaCorreo.style.color="green";

    }else{

        ayudaCorreo.textContent="Use Gmail, Hotmail, Outlook, iCloud o Yahoo.";
        ayudaCorreo.style.color="orangered";

    }

});


password.addEventListener("input", function () {

    // Solo letras y números
    this.value = this.value.replace(/[^A-Za-z0-9]/g,"");

    const tieneMayuscula = /[A-Z]/.test(this.value);
    const tieneMinuscula = /[a-z]/.test(this.value);
    const tieneNumero = /[0-9]/.test(this.value);

    let mensaje = "";

    if(this.value.length < 8){
        mensaje += "• Mínimo 8 caracteres<br>";
    }

    if(!tieneMayuscula){
        mensaje += "• Agregue una letra mayúscula<br>";
    }

    if(!tieneMinuscula){
        mensaje += "• Agregue una letra minúscula<br>";
    }

    if(!tieneNumero){
        mensaje += "• Agregue un número";
    }

    if(mensaje==""){

        seguridadPassword.innerHTML="✔ Contraseña segura";
        seguridadPassword.style.color="green";

    }else{

        seguridadPassword.innerHTML=mensaje;
        seguridadPassword.style.color="orangered";

    }

    if(confirmar.value!=""){

    if(confirmar.value===password.value){

        mensajeConfirmar.innerHTML="✔ Las contraseñas coinciden";
        mensajeConfirmar.style.color="green";

    }else{

        mensajeConfirmar.innerHTML="✖ Las contraseñas no coinciden";
        mensajeConfirmar.style.color="red";

    }

}

});


confirmar.addEventListener("input", function(){

    if(this.value==""){

        mensajeConfirmar.innerHTML="";
        return;

    }

    if(this.value===password.value){

        mensajeConfirmar.innerHTML="✔ Las contraseñas coinciden";
        mensajeConfirmar.style.color="green";

    }else{

        mensajeConfirmar.innerHTML="✖ Las contraseñas no coinciden";
        mensajeConfirmar.style.color="red";

    }

});


metodoPago.addEventListener("change", function () {

    cuentaPago.value = "";

    cuentaPago.placeholder = "Ingrese su " + metodoPago.value;

    if(metodoPago.value == "Yape"){

        ayudaPago.textContent = "Debe comenzar con 9 y tener 9 dígitos.";
        ayudaPago.style.color = "gray";

    }
    else if(metodoPago.value == "Plin"){

        ayudaPago.textContent = "Debe comenzar con 9 y tener 9 dígitos.";
        ayudaPago.style.color = "gray";

    }
    else if(metodoPago.value == "Visa"){

        ayudaPago.textContent = "Debe comenzar con 4 y tener 16 dígitos.";
        ayudaPago.style.color = "gray";

    }
    else if(metodoPago.value == "Mastercard"){

        ayudaPago.textContent = "Debe comenzar con 5 y tener 16 dígitos.";
        ayudaPago.style.color = "gray";

    }
    else{

        ayudaPago.textContent = "";

    }

});


cuentaPago.addEventListener("input", function () {

    this.value = this.value.replace(/[^0-9]/g,"");

    // Yape y Plin
    if(metodoPago.value=="Yape" || metodoPago.value=="Plin"){

        if(this.value.length>9){
            this.value=this.value.substring(0,9);
        }

        // Debe empezar con 9
        if(this.value.length>=1 && this.value.charAt(0)!="9"){
            this.value="";
        }

    }

    if(this.value.length==0){

        ayudaPago.textContent="Debe comenzar con 9 y tener 9 dígitos.";
        ayudaPago.style.color="gray";

    }
    else if(this.value.length<9){

        ayudaPago.textContent="Faltan " + (9-this.value.length) + " dígitos.";
        ayudaPago.style.color="orange";

    }
    else{

        ayudaPago.textContent="✔ Número válido.";
        ayudaPago.style.color="green";

    }

    // Visa
    if(metodoPago.value=="Visa"){

        if(this.value.length>16){
            this.value=this.value.substring(0,16);
        }

        // Debe empezar con 4
        if(this.value.length>=1 && this.value.charAt(0)!="4"){
            this.value="";
        }

    }

    if(this.value.length==0){

        ayudaPago.textContent="Debe comenzar con 4 y tener 16 dígitos.";
        ayudaPago.style.color="gray";

    }
    else if(this.value.length<16){

        ayudaPago.textContent="Faltan " + (16-this.value.length) + " dígitos.";
        ayudaPago.style.color="orange";

    }
    else{

        ayudaPago.textContent="✔ Tarjeta válida.";
        ayudaPago.style.color="green";

    }


    // Mastercard
    if(metodoPago.value=="Mastercard"){

        if(this.value.length>16){
            this.value=this.value.substring(0,16);
        }

        // Debe empezar con 5
        if(this.value.length>=1 && this.value.charAt(0)!="5"){
            this.value="";
        }

    }

    if(this.value.length==0){

        ayudaPago.textContent="Debe comenzar con 5 y tener 16 dígitos.";
        ayudaPago.style.color="gray";

    }
    else if(this.value.length<16){

        ayudaPago.textContent="Faltan " + (16-this.value.length) + " dígitos.";
        ayudaPago.style.color="orange";

    }
    else{

        ayudaPago.textContent="✔ Tarjeta válida.";
        ayudaPago.style.color="green";

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

    if(!/^[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,}( [A-Za-zÁÉÍÓÚáéíóúÑñ]{2,})+$/.test(nombre.value)){

        mensajeRegistro.textContent="Ingrese nombres y apellidos válidos.";

        return;

        const palabras = nombre.value.trim().split(" ");

        for(const palabra of palabras){

            // No permite 3 letras iguales seguidas dentro de una palabra
            if(/([A-Za-zÁÉÍÓÚáéíóúÑñ])\1+/i.test(palabra)){

                mensajeRegistro.textContent = "El nombre no puede contener letras repetidas.";

                return;

            }

        }
    }

    if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/.test(nombre.value)) {
    
        mensajeRegistro.textContent = "El nombre solo puede contener letras.";
    
    return;
    }

    const correoValido=/^[A-Za-z0-9]+(\.[A-Za-z0-9]+)*@(gmail|hotmail|outlook|icloud|yahoo)\.com$/;
    
    if(!correoValido.test(correo.value)){
    
        mensajeRegistro.textContent="Ingrese un correo electrónico válido.";
    
    return;
    }

    // para evitar usuarios repetidos como aaaaaaaa@gmail.com o 111111111@gmail.com
    const usuarioCorreo = correo.value.split("@")[0];

    if(/^([a-zA-Z0-9])\1+$/.test(usuarioCorreo)){

        mensajeRegistro.textContent = "El correo electrónico no parece válido.";

        return;

    }

    // para evitar usuarios formados solo por números
    if(/^\d+$/.test(usuarioCorreo)){

        mensajeRegistro.textContent = "El correo debe contener al menos una letra.";

        return;

    }




    if(!/^9\d{8}$/.test(telefono.value)){
        
        mensajeRegistro.textContent="Ingrese un número peruano válido.";
        
        return;
    }

    //para que no permita 911111111 o 922222222
    const repetidos=/^9(\d)\1{7}$/;

    if(repetidos.test(telefono.value)){

        mensajeRegistro.textContent="Ingrese un número de teléfono válido.";
        
        return;
    }


    const passwordValida = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

    if(!passwordValida.test(password.value)){

        mensajeRegistro.textContent = "La contraseña debe tener mínimo 8 caracteres, una mayúscula, una minúscula y un número.";

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


// =========================
// Validación de Yape y Plin
// =========================
if(metodoPago.value=="Yape" || metodoPago.value=="Plin"){

    if(!/^9\d{8}$/.test(cuentaPago.value)){

        mensajeRegistro.textContent="Yape o Plin deben comenzar con 9 y tener 9 dígitos.";

        return;

    }

    // Evita números repetidos
    const repetidoYape=/^9(\d)\1{7}$/;

    if(repetidoYape.test(cuentaPago.value)){

        mensajeRegistro.textContent="Ingrese un número de Yape o Plin válido.";

        return;

    }

}

// =========================
// Validación Visa
// =========================
if(metodoPago.value=="Visa"){

    if(!/^4\d{15}$/.test(cuentaPago.value)){

        mensajeRegistro.textContent="La tarjeta Visa debe comenzar con 4 y tener 16 dígitos.";

        return;

    }

    // Evita 4444444444444444
    const repetidaVisa=/^4(\d)\1{14}$/;

    if(repetidaVisa.test(cuentaPago.value)){

        mensajeRegistro.textContent="Ingrese un número de tarjeta Visa válido.";

        return;

    }

}

// =========================
// Validación Mastercard
// =========================
if(metodoPago.value=="Mastercard"){

    if(!/^5\d{15}$/.test(cuentaPago.value)){

        mensajeRegistro.textContent="La tarjeta Mastercard debe comenzar con 5 y tener 16 dígitos.";

        return;

    }

    // Evita 5555555555555555
    const repetidaMaster=/^5(\d)\1{14}$/;

    if(repetidaMaster.test(cuentaPago.value)){

        mensajeRegistro.textContent="Ingrese un número de tarjeta Mastercard válido.";

        return;

    }

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

// ============================
// Mostrar / ocultar contraseña
// ============================

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


verConfirmar.addEventListener("click", function(){

    if(confirmar.type=="password"){

        confirmar.type="text";

        iconoConfirmar.innerHTML=`
        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19C5 19 1 12 1 12a21.8 21.8 0 0 1 5.06-5.94"/>
        <path d="M9.9 4.24A10.94 10.94 0 0 1 12 5c7 0 11 7 11 7a21.9 21.9 0 0 1-3.17 4.19"/>
        <line x1="1" y1="1" x2="23" y2="23"/>
        `;

    }else{

        confirmar.type="password";

        iconoConfirmar.innerHTML=`
        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
        <circle cx="12" cy="12" r="3"/>
        `;

    }

});