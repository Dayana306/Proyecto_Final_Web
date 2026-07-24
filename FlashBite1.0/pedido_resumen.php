<?php
session_start();

include("conexion/conexion.php");
// Modo de apariencia
$modo = "claro";

if(isset($_SESSION["modo"])){
    $modo = $_SESSION["modo"];
}


$total = 0;

if(isset($_POST["direccion"])){

    $_SESSION["direccion"] = trim($_POST["direccion"]);

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

<title>Resumen del Pedido</title>

<link rel="icon" href="logo.jpeg">
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, Helvetica, sans-serif;
    background:#f2f2f2;
}

.contenedor{
    width:700px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0px 0px 10px rgba(0,0,0,.2);
}

h1{
    text-align:center;
    color:orangered;
    margin-bottom:30px;
}

.mensaje-stock{

    background:#fff3cd;
    color:#856404;
    border:1px solid #ffeeba;

    padding:15px;

    border-radius:8px;

    margin-bottom:25px;

    text-align:center;

    font-weight:bold;

}

.item{
    display:flex;
    justify-content:space-between;
    align-items:center;

    border-bottom:1px solid #ddd;

    padding:18px 0;
}

.total{
    text-align:right;
    font-size:24px;
    color:green;
    margin-top:30px;
}

.botones{
    display:flex;
    justify-content:space-between;
    margin-top:40px;
}

.botones a{
    background:orange;
    color:white;
    padding:12px 25px;
    border-radius:5px;
    text-decoration:none;
}

.botones button{
    background:orange;
    color:white;
    padding:12px 25px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
}

.botones button:hover{
    background:orangered;
}

.botones a:hover{
    background:orangered;
}

/*=========================================
        MODO OSCURO
=========================================*/

.dark{

    background:#121212;
    color:white;

}

.dark .contenedor{

    background:#1f1f1f;
    color:white;

}

.dark h1{

    color:#ff9800;

}

.dark .item{

    border-bottom:1px solid #555;

}

.dark h3{

    color:white;

}

.dark .total{

    color:#7CFC00;

}

.dark .mensaje-stock{

    background:#5c4700;
    color:#ffe082;
    border:1px solid #ffb300;

}

.dark .botones a{

    background:#ff9800;

}

.dark .botones button{

    background:#ff9800;

}

.dark .botones a:hover{

    background:#ff6d00;

}

.dark .botones button:hover{

    background:#ff6d00;

}

@media(max-width:768px){

.contenedor{
    width:95%;
}

.botones{
    flex-direction:column;
    gap:15px;
}

.botones a{
    text-align:center;
}

}


/*=========================================
        MODAL DE VERIFICACIÓN
=========================================*/

.modalPago{

    display:none;

    position:fixed;

    left:0;

    top:0;

    width:100%;

    height:100%;

    background:rgba(0,0,0,.6);

    justify-content:center;

    align-items:center;

    z-index:9999;

}

.contenidoPago{

    background:white;

    width:420px;

    padding:30px;

    border-radius:12px;

    text-align:center;

}

.dark .contenidoPago{

    background:#2b2b2b;

    color:white;

}

#codigoMostrado{

    margin:20px 0;

    color:orangered;

    letter-spacing:8px;

}

#codigoUsuario{

    text-align:center;

    font-size:22px;

}



</style>

</head>

<body class="<?= ($modo == "oscuro") ? "dark" : "" ?>">

<div class="contenedor">

<h1>📦 Resumen del Pedido</h1>

<?php

if(isset($_SESSION["mensaje_stock"])){

?>

<div class="mensaje-stock">

    <?php

    echo $_SESSION["mensaje_stock"];

    unset($_SESSION["mensaje_stock"]);

    ?>

</div>

<?php

}

?>

<?php

if(isset($_SESSION["carrito"]) && count($_SESSION["carrito"])>0){

    foreach($_SESSION["carrito"] as $indice => $item){

    $tipo = $item["tipo"];
    $id = intval($item["id"]);
    $cantidad = $item["cantidad"];

    if($tipo=="producto"){

        $consulta = mysqli_query($conexion,"
            SELECT *
            FROM productos
            WHERE id_producto=$id
        ");

    }else{

        $consulta = mysqli_query($conexion,"
            SELECT *
            FROM combos
            WHERE id_combo=$id
        ");

    }

    if($fila=mysqli_fetch_assoc($consulta)){

        $subtotal = $fila["precio_descuento"] * $cantidad;

        $total += $subtotal;

?>


<div class="item">

<div style="width:100%;">

<div style="display:flex;justify-content:space-between;align-items:center;">

<h3>

<?php echo $fila["nombre"]; ?>

</h3>

<a
href="php/actualizar_carrito.php?indice=<?php echo $indice; ?>&accion=eliminar"
onclick="return confirm('¿Eliminar este producto del carrito?');"
style="
background:#e53935;
color:white;
width:32px;
height:32px;
display:flex;
align-items:center;
justify-content:center;
border-radius:50%;
text-decoration:none;
font-weight:bold;
font-size:18px;
">

🗑

</a>

</div>

<div style="margin-top:12px;display:flex;align-items:center;gap:12px;">

<a
href="php/actualizar_carrito.php?indice=<?php echo $indice; ?>&accion=restar"
style="
background:#ff9800;
color:white;
width:32px;
height:32px;
display:flex;
justify-content:center;
align-items:center;
border-radius:50%;
text-decoration:none;
font-size:22px;
font-weight:bold;
">

−

</a>

<strong style="font-size:18px;">

<?php echo $cantidad; ?>

</strong>

<a
href="php/actualizar_carrito.php?indice=<?php echo $indice; ?>&accion=sumar"
style="
background:#4caf50;
color:white;
width:32px;
height:32px;
display:flex;
justify-content:center;
align-items:center;
border-radius:50%;
text-decoration:none;
font-size:22px;
font-weight:bold;
">

+

</a>

</div>

</div>


<div>

S/

<?php echo number_format($subtotal,2); ?>

</div>

</div>

<?php

        }

    }

?>

<div class="total">

<strong>

TOTAL:

S/

<?php echo number_format($total,2); ?>

</strong>

</div>

<?php

}else{

    header("Location: form_pedido.php");
    exit();

}

?>

<div class="botones">

<a href="form_pedido.php">

⬅ Volver

</a>

<form
action="php/guardar_pedido.php"
method="POST"
id="formResumen">

    <input
        type="hidden"
        name="direccion"
        value="<?php echo $_SESSION["direccion"] ?? ''; ?>">

    <button
    type="button"
    id="abrirPago">

        ✅ Confirmar Pedido

    </button>

</form>

</div>

</div>


<div id="modalPago" class="modalPago">

    <div class="contenidoPago">

        <h2>🔒 Verificación de pago</h2>

        <p style="margin-top:15px; line-height:1.6;">

            Para confirmar la compra, ingrese su
            <strong>código de verificación para compras en línea</strong>.

        </p>

        <br>

        <small>

            (Busque el código desde su aplicación bancaria,
            Yape, Plin o la plataforma de su tarjeta.)

        </small>

        <p
        style="
        color:#666;
        font-size:14px;
        margin-top:15px;
        ">

            <strong>Código de demostración:</strong>

        </p>

        <h1 id="codigoMostrado"></h1>

        <input
        type="text"
        id="codigoUsuario"
        maxlength="6"
        placeholder="Ingrese el código">

        <p
        id="mensajeCodigo"
        style="color:red;font-weight:bold;">

        </p>

        <button id="btnConfirmarPago">

            Confirmar Pago

        </button>

        <br><br>

        <button
        type="button"
        id="btnCancelarPago"
        class="cancelar">

            Cancelar

        </button>

    </div>

</div>


<script src="js/modo.js"></script>

<script>

const modalPago=document.getElementById("modalPago");

const abrirPago=document.getElementById("abrirPago");

const cancelarPago=document.getElementById("btnCancelarPago");

const confirmarPago=document.getElementById("btnConfirmarPago");

const codigoMostrado=document.getElementById("codigoMostrado");

const codigoUsuario=document.getElementById("codigoUsuario");

const mensajeCodigo=document.getElementById("mensajeCodigo");

let codigo="";

abrirPago.addEventListener("click",function(){

    codigo=Math.floor(
        100000+Math.random()*900000
    ).toString();

    codigoMostrado.textContent=codigo;

    codigoUsuario.value="";

    mensajeCodigo.textContent="";

    modalPago.style.display="flex";

});

cancelarPago.addEventListener("click",function(){

    modalPago.style.display="none";

});

confirmarPago.addEventListener("click",function(){

    if(codigoUsuario.value!=codigo){

        mensajeCodigo.textContent="Código incorrecto.";

        return;

    }

    modalPago.style.display="none";

    document.getElementById("formResumen").submit();

});

</script>


</body>

</html>