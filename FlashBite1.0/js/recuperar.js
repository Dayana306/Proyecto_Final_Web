
const formulario = document.getElementById("formRecuperar");

const correo = document.getElementById("correo");
const password = document.getElementById("password");
const password2 = document.getElementById("password2");

const verPassword = document.getElementById("verPassword");
const verConfirmar = document.getElementById("verConfirmar");

const iconoPassword = document.getElementById("iconoPassword");
const iconoConfirmar = document.getElementById("iconoConfirmar");

const mensaje = document.getElementById("mensajeRecuperar");
const seguridadPassword = document.getElementById("seguridadPassword");
const ayudaCorreo = document.getElementById("ayudaCorreo");
const mensajeConfirmar = document.getElementById("mensajeConfirmar");


correo.addEventListener("input", function(){

    const correoValido=/^[a-zA-Z0-9._%+-]+@(gmail|hotmail|outlook|icloud|yahoo)\.com$/;

    if(this.value==""){

        ayudaCorreo.innerHTML="Ejemplo: usuario@gmail.com";
        ayudaCorreo.style.color="gray";

    }
    else if(correoValido.test(this.value)){

        ayudaCorreo.innerHTML="✔ Correo válido";
        ayudaCorreo.style.color="green";

    }
    else{

        ayudaCorreo.innerHTML="Ingrese un correo válido (gmail, hotmail, outlook, icloud o yahoo)";
        ayudaCorreo.style.color="orangered";

    }

});


password.addEventListener("input", function(){

    // No permite espacios
    this.value = this.value.replace(/\s/g,"");

    const tieneMayuscula = /[A-Z]/.test(this.value);
    const tieneMinuscula = /[a-z]/.test(this.value);
    const tieneNumero = /[0-9]/.test(this.value);

    let mensajePassword="";

    if(this.value.length<8){
        mensajePassword+="• Mínimo 8 caracteres<br>";
    }

    if(!tieneMayuscula){
        mensajePassword+="• Agregue una mayúscula<br>";
    }

    if(!tieneMinuscula){
        mensajePassword+="• Agregue una minúscula<br>";
    }

    if(!tieneNumero){
        mensajePassword+="• Agregue un número";
    }

    if(mensajePassword==""){

        seguridadPassword.innerHTML="✔ Contraseña segura";
        seguridadPassword.style.color="green";

    }else{

        seguridadPassword.innerHTML=mensajePassword;
        seguridadPassword.style.color="orangered";

    }

    // Si ya escribió la confirmación
    if(password2.value!=""){

        if(password.value===password2.value){

            mensajeConfirmar.innerHTML="✔ Las contraseñas coinciden";
            mensajeConfirmar.style.color="green";

        }else{

            mensajeConfirmar.innerHTML="✖ Las contraseñas no coinciden";
            mensajeConfirmar.style.color="red";

        }

    }

});



password2.addEventListener("input", function(){

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



formulario.addEventListener("submit", function(evento){

    mensaje.textContent = "";
    mensaje.style.color = "red";

    if(

        correo.value.trim()==="" ||

        password.value.trim()==="" ||

        password2.value.trim()===""

    ){

        const correoValido = /^[a-zA-Z0-9._%+-]+@(gmail|hotmail|outlook|icloud|yahoo)\.com$/;

        if(!correoValido.test(correo.value)){

            evento.preventDefault();

            mensaje.textContent = "Ingrese un correo electrónico válido.";

            return;

        }



        evento.preventDefault();

        mensaje.textContent="Complete todos los campos.";

        return;

    }

    
    const passwordValida = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

    if(!passwordValida.test(password.value)){

        evento.preventDefault();

        mensaje.textContent = "La contraseña debe tener mínimo 8 caracteres, una mayúscula, una minúscula y un número.";

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

    if(password2.type=="password"){

        password2.type="text";

        iconoConfirmar.innerHTML=`
        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19C5 19 1 12 1 12a21.8 21.8 0 0 1 5.06-5.94"/>
        <path d="M9.9 4.24A10.94 10.94 0 0 1 12 5c7 0 11 7 11 7a21.9 21.9 0 0 1-3.17 4.19"/>
        <line x1="1" y1="1" x2="23" y2="23"/>
        `;

    }else{

        password2.type="password";

        iconoConfirmar.innerHTML=`
        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
        <circle cx="12" cy="12" r="3"/>
        `;

    }

});