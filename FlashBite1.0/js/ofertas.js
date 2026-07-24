
let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

const contador = document.getElementById("contadorCarrito");

const productos = [

    {
        id:32,
        nombre:"Pizza Familiar",
        precio:25
    },

    {
        id:33,
        nombre:"Hamburguesa",
        precio:18
    },

    {
        id:34,
        nombre:"Pollo Broaster",
        precio:15
    }

];

function addToCart(id){

    const producto = productos.find(function(item){

        return item.id == id;

    });

    if(!producto){

        alert("Producto no encontrado");

        return;

    }

    const existe = carrito.find(function(item){

        return item.id == id;

    });

    if(existe){


        existe.cantidad++;

    }else{

        carrito.push({

            id:producto.id,

            nombre:producto.nombre,

            precio:producto.precio,

            cantidad:1

        });

    }

    localStorage.setItem(

        "carrito",

        JSON.stringify(carrito)

    );

    actualizarCarrito();

    alert(producto.nombre + " agregado al pedido.");

}

function actualizarCarrito(){

    contador.textContent = carrito.length;

}

actualizarCarrito();

const tarjetas = document.querySelectorAll(".oferta");

tarjetas.forEach(function(card){

    card.addEventListener("mouseover",function(){

        card.style.boxShadow="0 0 20px orange";

    });

    card.addEventListener("mouseout",function(){

        card.style.boxShadow="0 0 10px rgba(0,0,0,.2)";

    });

});