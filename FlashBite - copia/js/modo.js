
const botonModo = document.getElementById("modoOscuro");

if(localStorage.getItem("modo") === "oscuro"){

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