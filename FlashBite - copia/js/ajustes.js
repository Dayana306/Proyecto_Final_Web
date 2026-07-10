
if (localStorage.getItem("modo") == "oscuro") {
    document.body.classList.add("dark");
}

function eliminarCuenta() {

    let respuesta = confirm(
        "¿Está seguro de eliminar su cuenta?\nEsta acción no se puede deshacer."
    );

    if (!respuesta) {
        return;
    }

    fetch("php/eliminar_cuenta.php", {
        method: "POST"
    })
    .then(response => response.json())
    .then(data => {

        if (data.ok) {

            alert("La cuenta fue eliminada correctamente.");

            window.location.href = "bienvenida.html";

        } else {

            alert(data.error);

        }

    })
    .catch(error => {

        console.error(error);

        alert("Error de conexión.");

    });

}
const selectorIdioma = document.getElementById("idioma");

if (selectorIdioma) {

    selectorIdioma.addEventListener("change", function () {

        fetch("php/guardar_idioma.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },

            body: "idioma=" + encodeURIComponent(this.value)

        })
        .then(response => response.json())
        .then(data => {

            if (data.ok) {

                location.reload();

            } else {

                alert(data.error);

            }

        })
        .catch(error => {

            console.error(error);

            alert("No se pudo guardar el idioma.");

        });

    });

}

