

function eliminarCuenta(){

    if(!confirm("¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.")){
        return;
    }

    fetch("php/eliminar_cuenta.php",{
        method:"POST"
    })
    .then(res => res.json())
    .then(data => {

        if(data.ok){

            alert("La cuenta fue eliminada correctamente.");

            window.location.href="bienvenida.html";

        }else{

            alert(data.error);

        }

    })
    .catch(()=>{

        alert("Ocurrió un error al eliminar la cuenta.");

    });

}