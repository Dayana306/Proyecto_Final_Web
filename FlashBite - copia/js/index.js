
const nombreUsuario = document.getElementById("nombreUsuario");
const botonUsuario = document.querySelector(".btn-usuario");
const titulo = document.querySelector(".contenido h2");


botonUsuario.href = "usuario.php";

const hora = new Date().getHours();

let saludo = "";

if(hora < 12){

    saludo = "☀ Buenos días";

}

else if(hora < 18){

    saludo = "🌤 Buenas tardes";

}

else{

    saludo = "🌙 Buenas noches";

}

titulo.textContent =
saludo + " ¡Bienvenido a Flash Bite!";

const logo = document.querySelector("header img");

logo.addEventListener("dblclick", function(){

    document.body.classList.toggle("dark");

    if(document.body.classList.contains("dark")){

        localStorage.setItem("modo","oscuro");

    }else{

        localStorage.setItem("modo","claro");

    }

});


if(localStorage.getItem("modo")=="oscuro"){

    document.body.classList.add("dark");

}

const tarjetas = document.querySelectorAll(".card");

tarjetas.forEach(function(card){

    card.addEventListener("mouseover", function(){

        card.style.transform = "scale(1.05)";

    });

    card.addEventListener("mouseout", function(){

        card.style.transform = "scale(1)";

    });

});