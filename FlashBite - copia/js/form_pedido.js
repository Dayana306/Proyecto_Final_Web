
const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

const lista = document.getElementById("listaProductos");
const totalTexto = document.getElementById("total");
const direccion = document.getElementById("direccion");

let total = 0;

totalTexto.textContent = "Total: S/ " + total.toFixed(2);

function confirmarPedido(){

    if(carrito.length === 0){

        alert("Debe agregar productos al carrito.");

        return;

    }

    if(direccion.value.trim() === ""){

        alert("Ingrese una dirección.");

        direccion.focus();

        return;

    }

    const pedido = {

        numero: Math.floor(Math.random()*9000)+1000,

        cliente: localStorage.getItem("nombreUsuario"),

        direccion: direccion.value,

        productos: carrito,

        total: total,

        estado:"En preparación"

    };

    let pedidos = JSON.parse(localStorage.getItem("pedidos")) || [];

    pedidos.push(pedido);

    localStorage.setItem("pedidos",JSON.stringify(pedidos));

    localStorage.removeItem("carrito");

    localStorage.removeItem("direccion");

    alert("Pedido registrado correctamente.");

    window.location.href="pedidos.php";

}

direccion.addEventListener("input",function(){

    direccion.style.borderColor="green";

});

if(localStorage.getItem("modo")=="oscuro"){

    document.body.classList.add("dark");

}

if(botonModo){

    botonModo.addEventListener("click",function(){

        document.body.classList.toggle("dark");

        if(document.body.classList.contains("dark")){

            localStorage.setItem(
                "modo",
                "oscuro"
            );

        }else{

            localStorage.setItem(
                "modo",
                "claro"
            );

        }

    });

}