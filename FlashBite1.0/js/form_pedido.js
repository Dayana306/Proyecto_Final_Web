
const direccion = document.getElementById("direccion");
const contador = document.getElementById("contadorDireccion");
const btnModo = document.getElementById("botonModo");
const errorDireccion = document.getElementById("errorDireccion");

direccion.addEventListener("input", function () {

    let texto = direccion.value;

    // Permitir solo letras, números, espacios, punto, coma, # y guion
    texto = texto.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s.,#-]/g, "");

    // Quitar espacios repetidos
    texto = texto.replace(/\s{2,}/g, " ");

    // Primera letra en mayúscula
    if(texto.length > 0){

        texto =
        texto.charAt(0).toUpperCase() +
        texto.slice(1);

    }

    direccion.value = texto;

    if(texto.length >= 8){

    direccion.style.borderColor = "green";

}else{

    direccion.style.borderColor = "#ccc";

}

    if(contador){

        contador.textContent =
        texto.length + "/150";

    }

});

/*

if(localStorage.getItem("modo")=="oscuro"){

    document.body.classList.add("dark");

}

*/

if(btnModo){

    btnModo.addEventListener("click",function(){

        document.body.classList.toggle("dark");

// No es necesario guardar en localStorage.
// guardar_modo.php ya actualiza la sesión.

    });

}

const botonVisualizar = document.querySelector(
'button[formaction="pedido_resumen.php"]'
);

const mensajePedido = document.getElementById("mensajePedido");

if(botonVisualizar){

    botonVisualizar.addEventListener("click", function(e){

        const resumen = document.querySelector(".resumen-pedido");

        if(resumen == null){

            e.preventDefault();

            mensajePedido.style.display = "block";

        }else{

            mensajePedido.style.display = "none";

        }

    });

}

document.getElementById("formPedido")
.addEventListener("submit", function(e){

    errorDireccion.textContent = "";

    const texto = direccion.value.trim();

    if(/^\d/.test(texto)){

    errorDireccion.textContent =
    "La dirección no debe comenzar con un número.";

    direccion.focus();

    e.preventDefault();

    return;

    }

    if(texto.length < 8){

        errorDireccion.textContent =
        "Ingrese una dirección más completa.";

        direccion.focus();

        e.preventDefault();

        return;
    }

    // Debe tener letras
    if(!/[A-Za-zÁÉÍÓÚáéíóúÑñ]/.test(texto)){

        errorDireccion.textContent =
        "La dirección debe contener letras.";

        direccion.focus();

        e.preventDefault();

        return;
    }

    // Debe tener al menos un número
    if(!/\d/.test(texto)){

        errorDireccion.textContent =
        "La dirección debe contener un número.";

        direccion.focus();

        e.preventDefault();

        return;
    }

    // Debe tener al menos dos palabras
if(texto.split(/\s+/).length < 2){

    errorDireccion.textContent =
    "Ingrese una dirección más completa.";

    direccion.focus();

    e.preventDefault();

    return;

}

const palabras = texto.split(/\s+/);

for(let palabra of palabras){

    if(palabra.length >= 4){

        if(/^([A-Za-zÁÉÍÓÚáéíóúÑñ])\1+$/.test(palabra)){

            errorDireccion.textContent =
            "La dirección contiene palabras inválidas.";

            direccion.focus();

            e.preventDefault();

            return;

        }

    }

}

if(palabras[0].length < 3){

    errorDireccion.textContent =
    "El nombre de la calle o avenida es demasiado corto.";

    direccion.focus();

    e.preventDefault();

    return;

}

const vias = [
    "calle",
    "jr",
    "jiron",
    "av",
    "avenida",
    "pasaje",
    "psje",
    "urbanizacion",
    "urb",
    "mz",
    "manzana",
    "lote"
];

let contieneVia = false;

for(let via of vias){

    if(texto.toLowerCase().includes(via)){

        contieneVia = true;
        break;

    }

}

if(!contieneVia){

    errorDireccion.textContent =
    "La dirección debe incluir Calle, Av., Jr., Urb., Pasaje, etc.";

    direccion.focus();

    e.preventDefault();

    return;

}


// No permitir una sola letra repetida
const soloLetras = texto.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g,"");

if(soloLetras.length > 0){

    if(/^([A-Za-zÁÉÍÓÚáéíóúÑñ])\1+$/i.test(soloLetras)){

        errorDireccion.textContent =
        "Dirección inválida.";

        direccion.focus();

        e.preventDefault();

        return;

    }

}

// No permitir un solo número repetido
const soloNumeros = texto.replace(/\D/g,"");

if(soloNumeros.length > 10){

    errorDireccion.textContent =
    "La dirección contiene demasiados números.";

    direccion.focus();

    e.preventDefault();

    return;

}

if(soloNumeros.length > 0){

    if(/^(\d)\1+$/.test(soloNumeros)){

        errorDireccion.textContent =
        "Dirección inválida.";

        direccion.focus();

        e.preventDefault();

        return;

    }

}

const simbolos = (texto.match(/[.,#-]/g) || []).length;

if(simbolos > 5){

    errorDireccion.textContent =
    "La dirección contiene demasiados símbolos.";

    direccion.focus();

    e.preventDefault();

    return;

}

const repetidas = /^(\w+)( \1){2,}$/i;

if(repetidas.test(texto)){

    errorDireccion.textContent =
    "Dirección inválida.";

    direccion.focus();

    e.preventDefault();

    return;

}

errorDireccion.textContent = "";

});


const modalPago = document.getElementById("modalPago");

const abrirPago = document.getElementById("abrirPago");

const cancelarPago = document.getElementById("btnCancelarPago");

const confirmarPago = document.getElementById("btnConfirmarPago");

const codigoMostrado = document.getElementById("codigoMostrado");

const codigoUsuario = document.getElementById("codigoUsuario");

const mensajeCodigo = document.getElementById("mensajeCodigo");

let codigo = "";

if (abrirPago) {

    abrirPago.addEventListener("click", function(){

        if(!document.getElementById("formPedido").reportValidity()){
            return;
        }

        codigo = Math.floor(
            100000 + Math.random()*900000
        ).toString();

        codigoMostrado.textContent = codigo;

        codigoUsuario.value = "";

        mensajeCodigo.textContent = "";

        modalPago.style.display = "flex";

    });

}
if (cancelarPago) {

    cancelarPago.addEventListener("click", function(){

        modalPago.style.display = "none";

    });

}

if (confirmarPago) {

    confirmarPago.addEventListener("click", function(){

        if(codigoUsuario.value != codigo){

            mensajeCodigo.textContent = "Código incorrecto.";

            return;

        }

        modalPago.style.display = "none";

        document.getElementById("formPedido").submit();

    });

}

confirmarPago.addEventListener("click",function(){

    if(codigoUsuario.value != codigo){

        mensajeCodigo.textContent="Código incorrecto.";

        return;

    }

    modalPago.style.display="none";

    document.getElementById("formPedido").submit();

});