<?php
session_start();

include("conexion/conexion.php");
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

</style>

</head>

<body>

<div class="contenedor">

<h1>📦 Resumen del Pedido</h1>

<?php

if(isset($_SESSION["carrito"]) && count($_SESSION["carrito"])>0){

    foreach($_SESSION["carrito"] as $item){

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

<div>

<h3>

<?php echo $fila["nombre"]; ?>

</h3>

<p>

Cantidad:

<strong>

<?php echo $cantidad; ?>

</strong>

</p>

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

<form action="php/guardar_pedido.php" method="POST">

    <input
        type="hidden"
        name="direccion"
        value="<?php echo $_SESSION["direccion"] ?? ''; ?>">

    <button type="submit">

        ✅ Confirmar Pedido

    </button>

</form>

</div>

</div>

</body>

</html>