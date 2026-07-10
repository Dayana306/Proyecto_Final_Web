
function cambiarModo(){

    document.body.classList.toggle("dark");

    if(document.body.classList.contains("dark")){

        localStorage.setItem("modo","oscuro");

    }else{

        localStorage.setItem("modo","claro");

    }

}

window.onload = function(){

    if(localStorage.getItem("modo")=="oscuro"){

        document.body.classList.add("dark");

    }

}

function editarPerfil(){

    alert("Esta opción estará disponible en la siguiente versión del sistema.");

}

function cerrarSesion(){

    if(confirm("¿Seguro que deseas cerrar sesión?")){

        window.location.href="php/cerrar_sesion.php";

    }

}