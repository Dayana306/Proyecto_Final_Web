const botonModo = document.getElementById("modoOscuro");

if (botonModo) {

    botonModo.addEventListener("click", function () {

        document.body.classList.toggle("dark");

        let modo = document.body.classList.contains("dark")
            ? "oscuro"
            : "claro";

        fetch("php/guardar_modo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "modo=" + modo
        });

    });

}