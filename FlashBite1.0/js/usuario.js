
const botonModo = document.getElementById("modoOscuro");

if(botonModo){

    botonModo.addEventListener("click", function(){

        document.body.classList.toggle("dark");


        let modo = "claro";


        if(document.body.classList.contains("dark")){

            modo = "oscuro";

        }


        fetch("php/guardar_modo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "modo=" + modo
        })
        .then(response => response.text())
        .then(data => {
            console.log("Respuesta del servidor:", data);
        })
        .catch(error => {
            console.error(error);
        });


    });

}

function editarPerfil(){

    document.getElementById("modalEditar").style.display="flex";

}

function cerrarModal(){

    document.getElementById("modalEditar").style.display="none";

}

function cerrarSesion(){

    if(confirm("¿Seguro que deseas cerrar sesión?")){

        window.location.href="php/cerrar_sesion.php";

    }

}



const formEditar = document.getElementById("formEditar");

if(formEditar){

    const telefono = document.getElementById("editarTelefono");
    const metodo = document.getElementById("editarMetodo");
    const cuenta = document.getElementById("editarCuenta");
    const mensaje = document.getElementById("mensajeEditar");

    telefono.addEventListener("input",function(){

        this.value=this.value.replace(/[^0-9]/g,"").substring(0,9);

    });

    metodo.addEventListener("change",function(){

        cuenta.value="";

        if(this.value=="Yape" || this.value=="Plin"){

            cuenta.placeholder="Ingrese su número de Yape o Plin";

        }else{

            cuenta.placeholder="Ingrese los 16 dígitos de la tarjeta";

        }

    });

    cuenta.addEventListener("input",function(){

        this.value=this.value.replace(/[^0-9]/g,"");

        if(metodo.value=="Yape" || metodo.value=="Plin"){

            this.value=this.value.substring(0,9);

        }else{

            this.value=this.value.substring(0,16);

        }

    });

    formEditar.addEventListener("submit",function(e){

        mensaje.textContent="";

        if(!/^[0-9]{9}$/.test(telefono.value)){

            e.preventDefault();

            mensaje.textContent="El teléfono debe tener exactamente 9 dígitos.";

            return;

        }

        if((metodo.value=="Yape" || metodo.value=="Plin") && !/^[0-9]{9}$/.test(cuenta.value)){

            e.preventDefault();

            mensaje.textContent="Yape o Plin deben tener exactamente 9 dígitos.";

            return;

        }

        if((metodo.value=="Visa" || metodo.value=="Mastercard") && !/^[0-9]{16}$/.test(cuenta.value)){

            e.preventDefault();

            mensaje.textContent="La tarjeta debe tener exactamente 16 dígitos.";

            return;

        }

    });

}