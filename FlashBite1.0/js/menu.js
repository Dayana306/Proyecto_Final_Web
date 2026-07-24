
// ===========================
// EFECTO HOVER DE LAS TARJETAS
// ===========================
const tarjetas = document.querySelectorAll(".card");

tarjetas.forEach(function(card){

    card.addEventListener("mouseover",function(){

        card.style.boxShadow="0 0 20px orange";

    });

    card.addEventListener("mouseout",function(){

        card.style.boxShadow="0 0 10px rgba(0,0,0,.2)";

    });

});

// ===========================
// MOSTRAR CONTADOR
// ===========================

const botonesAgregar = document.querySelectorAll(".btnAgregar");

console.log(botonesAgregar);
console.log(botonesAgregar.length);

botonesAgregar.forEach(function(boton){

    boton.addEventListener("click",function(e){

        console.log("CLICK");

        e.preventDefault();

        const acciones = this.closest(".acciones-producto");

        const formulario = acciones.querySelector(".formAgregar");

        const contador = acciones.querySelector(".contadorProducto");

        const botonAgregar = acciones.querySelector(".btnAgregar");


        if(contador){

            botonAgregar.style.display = "none";

            contador.style.display = "flex";

        }

    });

});

// ===========================
// CONTROLES + Y -
// ===========================

const tarjetasProductos = document.querySelectorAll(".card");

tarjetasProductos.forEach(function(tarjeta){

    const contador = tarjeta.querySelector(".contadorProducto");

    if(!contador){
        return;
    }

    const botonMenos = contador.querySelector(".btnMenos");
    const botonMas = contador.querySelector(".btnMas");
    const cantidad = contador.querySelector(".cantidad");

    const acciones = contador.closest(".acciones-producto");
    const formulario = acciones.querySelector(".formAgregar");
    const cantidadInput = acciones.querySelector(".cantidadInput");
    const imagen = acciones.closest(".card").querySelector("img");

    const stockTexto =
        acciones.parentElement.querySelector(".stock");

    if(!stockTexto){

        return;

    }

    const stockInicial = 
    parseInt(stockTexto.dataset.stock);

    let stockVisual = stockInicial;

    function actualizarStockVisual(){

        const restante = stockVisual;

        if(restante <= 0){

            stockTexto.innerHTML = "❌ Producto agotado";
            stockTexto.className = "stock agotado";

            imagen.classList.add("imagenAgotada");

            botonMas.disabled = true;

        }

        else{

            imagen.classList.remove("imagenAgotada");

            botonMas.disabled = false;

            if(restante <= 3){

                stockTexto.innerHTML =
                "🔥 Últimas unidades ("+restante+")";

                stockTexto.className = "stock ultimas";

            }

            else if(restante <= 5){

                stockTexto.innerHTML =
                "⚠️ Quedan pocas unidades ("+restante+")";

                stockTexto.className = "stock pocas";

            }

            else{

                stockTexto.innerHTML =
                "✅ Disponible ("+restante+" unidades)";

                stockTexto.className = "stock disponible";

            }
    
        }

    }

    let stock = 0;

    // Obtener el número del texto:
    // "Disponible (6 unidades)"
    const encontrado = stockTexto.textContent.match(/\d+/);

    if(encontrado){

        stock = parseInt(encontrado[0]);

    }

    let numero = 1;
    cantidadInput.value = numero;
    actualizarStockVisual();

    botonMas.addEventListener("click",function(){

        if(numero == stock){

            alert("Ya no puedes agregar más unidades de este producto.");

            return;

        }

        numero++;

        stockVisual--;

        cantidad.textContent = numero;

        cantidadInput.value = numero;

        actualizarStockVisual();

    });

    botonMenos.addEventListener("click", function(){

        if(numero == 1){

            contador.style.display = "none";

            const botonAgregar =
                acciones.querySelector(".btnAgregar");

            botonAgregar.style.display = "block";

            numero = 1;

            cantidad.textContent = "1";

            cantidadInput.value = 1;

            stockVisual = stockInicial;

            actualizarStockVisual();

            return;

        }

        numero--;
        stockVisual++;

        cantidad.textContent = numero;
        cantidadInput.value = numero;

        actualizarStockVisual();

    });

});
