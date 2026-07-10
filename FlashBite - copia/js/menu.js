
let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

const contador = document.getElementById("contadorCarrito");

const productos = [

    {id:32,nombre:"Pizza Familiar",precio:25},

    {id:33,nombre:"Hamburguesa",precio:18},

    {id:34,nombre:"Pollo Broaster",precio:15},

    {id:35,nombre:"Ensalada",precio:10},

    {id:36,nombre:"Pay de Limón",precio:5},

    {id:37,nombre:"Pay de Manzana",precio:29.5},

    {id:38,nombre:"Brownie",precio:19.3},

    {id:39,nombre:"Donas",precio:30}

];

if(contador){

    actualizarCarrito();

}

function addToCart(id){

    const producto = productos.find(function(item){

        return item.id == id;

    });

    if(!producto){

        alert("Producto no encontrado");

        return;

    }

    const existente = carrito.find(function(item){

        return item.id == id;

    });

    if(existente){

        existente.cantidad++;

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

    alert(producto.nombre + " agregado al carrito.");

}

function actualizarCarrito(){

    if(contador){

        contador.textContent = carrito.length;

    }

}

const botonModo = document.getElementById("modoOscuro");

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

const tarjetas = document.querySelectorAll(".card");

tarjetas.forEach(function(card){

    card.addEventListener("mouseover",function(){

        card.style.boxShadow="0 0 20px orange";

    });

    card.addEventListener("mouseout",function(){

        card.style.boxShadow="0 0 10px rgba(0,0,0,.2)";

    });

});

const titulo = document.querySelector("header h1");

titulo.textContent += " (" + productos.length + " productos)";
