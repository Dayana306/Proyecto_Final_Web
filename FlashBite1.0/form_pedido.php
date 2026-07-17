<?php

/*=========================================================
    FORMULARIO DE PEDIDO 
    Este archivo permite
    - Mostrar el formulario del pedido
    - Mostrar los productos agregados al carrito
    - Calcular el total del pedido
    - Enviar la información a guardar_pedido.php
=========================================================*/

/*=========================================================
    Iniciar la sesión para acceder al carrito
=========================================================*/

session_start();

$modo = "claro";

if (isset($_SESSION["modo"])) {
    $modo = $_SESSION["modo"];
}

/*=========================================================
    Conectar con la base de datos
=========================================================*/

include("conexion/conexion.php");

/*=========================================================
    Inicializar el total del pedido
=========================================================*/

$total = 0;

?>

<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <title>Flash Bite</title>
    <link rel="icon" href="logo.jpeg" type="image/jpeg">
    <style>

        /*=====================================================
            CONFIGURACIÓN GENERAL
        =====================================================*/

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, Helvetica, sans-serif;
            background:#f2f2f2;
        }

        /*=====================================================
            CONTENEDOR PRINCIPAL
        =====================================================*/

        .contenedor{
            display:grid;
            width:400px;
            background:white;
            margin:40px auto;
            padding:30px;
            border-radius:10px;
            box-shadow:0px 0px 10px rgba(0,0,0,.2);
            position:relative;
            grid-template-columns:1fr;
            gap:20px;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
            color:orangered;
        }

        label{
            font-weight:bold;
        }

        input,
        select{
            width:100%;
            padding:12px;
            margin-top:8px;
            margin-bottom:15px;
            border:1px solid #ccc;
            border-radius:5px;
        }

        .checkbox{
            margin-bottom:15px;
        }

        /*=====================================================
            BOTONES
        =====================================================*/

        button{
            width:100%;
            padding:12px;
            background:orange;
            color:white;
            border:none;
            border-radius:5px;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
        }

        button:hover{
            background:orangered;
        }

        .cancelar{
            background:#dc3545;
        }

        .cancelar:hover{
            background:#b02a37;
        }

        .btn-pedidos{
            display:block;
            width:100%;
            padding:12px;
            margin-top:10px;
            background:#28a745;
            color:white;
            text-decoration:none;
            text-align:center;
            border-radius:5px;
            font-size:16px;
            transition:.3s;
        }

        .btn-pedidos:hover{
            background:#218838;
        }

        /*=====================================================
            ENLACES
        =====================================================*/

        .enlaces{
            text-align:center;
            margin-top:20px;
        }

        .enlaces a{
            text-decoration:none;
            color:orangered;
            font-weight:bold;
            margin:10px;
        }

        .cerrar{
            position:absolute;
            top:10px;
            right:15px;
            text-decoration:none;
            font-size:24px;
            color:black;
        }

        .cerrar:hover{
            color:orangered;
        }

        /*=====================================================
            PRODUCTOS DEL CARRITO
        =====================================================*/

        .item{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:15px;
            border:1px solid #ddd;
            border-radius:8px;
            margin-bottom:12px;
        }

        .item a{
            color:red;
            text-decoration:none;
            font-weight:bold;
        }

        .item a:hover{
            text-decoration:underline;
        }

        #total{
            text-align:right;
            color:orangered;
            margin-top:15px;
        }

        /*=====================================================
            MODO OSCURO
        =====================================================*/

        .dark{
            background:#121212;
            color:white;
        }

        .dark .contenedor{
            background:#1f1f1f;
            color:white;
            box-shadow:0 0 15px rgba(0,0,0,.6);
        }

        .dark h2,
        .dark h3,
        .dark label,
        .dark #total{
            color:#ff9800;
        }

        .dark input{
            background:#2b2b2b;
            color:white;
            border:1px solid #555;
        }

        .dark input::placeholder{
            color:#bdbdbd;
        }

        .dark .item{
            border-bottom:1px solid #444;
        }

        .dark hr{
            border:1px solid #444;
        }

        .dark button{
            background:#ff9800;
        }

        .dark button:hover{
            background:#ff6d00;
        }

        .dark .enlaces a{
            color:#ffb74d;
        }

        .dark .cerrar{
            color:white;
        }

        .dark .cerrar:hover{
            color:#ff9800;
        }

        /*=====================================================
            RESPONSIVE
        =====================================================*/

        @media(max-width:1200px){
            .contenedor{
                width:95%;
            }
        }

        @media(max-width:768px){
            .contenedor{
                width:95%;
                padding:20px;
            }
            .enlaces{
                display:flex;
                flex-direction:column;
                gap:15px;
            }
        }

        @media(max-width:480px){
            .contenedor{
                width:95%;
            }
        }

        /*=====================================================
            TARJETA RESUMEN DEL PEDIDO
        =====================================================*/

        .resumen-pedido{

            background:#fff3e0;
            border:2px solid #ff9800;
            border-radius:12px;
            padding:25px;
            text-align:center;
            box-shadow:0 4px 10px rgba(0,0,0,.15);
            margin-bottom:20px;

        }

        .resumen-pedido h2{

            color:orangered;
            margin-bottom:20px;

        }

        .resumen-pedido p{

            font-size:18px;
            color: rgb(0,0,0);
            margin:12px 0;

        }

        .resumen-pedido .total{

            font-size:24px;
            color:#2e7d32;
            font-weight:bold;

        }

        .resumen-pedido .mensaje{

            font-size:15px;
            color:#666;
            margin-top:20px;
        }

    </style>

</head>

<body class="<?= ($modo == "oscuro") ? "dark" : "" ?>">

<div class="contenedor">
    <a href="menu.php" class="cerrar">✖</a>
    <h2>Formulario de Pedido</h2>

    <!--====================================================
        FORMULARIO PRINCIPAL
    =====================================================-->

    <form action="php/guardar_pedido.php" method="POST" id="formPedido">
        <label>Dirección</label>

        <input
            type="text"
            id="direccion"
            name="direccion"
            placeholder="Ingrese su dirección"
            maxlength="150"
            required>


        <!--=====================================================
    RESUMEN DEL PEDIDO
    En lugar de mostrar cada producto del carrito,
    mostraremos un resumen con la cantidad total
    de productos agregados y el monto aproximado

    el detalle completo podrá visualizarse en una
    página aparte (pedido_resumen.php)
======================================================-->

<div id="listaProductos">

<?php

/*=====================================================
    Inicializar variables
======================================================*/

$cantidadProductos = 0;
$total = 0;

/*=====================================================
    Verificar si existe el carrito
======================================================*/

if(isset($_SESSION["carrito"]) && count($_SESSION["carrito"])>0){

    //Cantidad total de productos
    $cantidadProductos = 0;

    //Recorrer todos los productos del carrito
    foreach($_SESSION["carrito"] as $item){

        $cantidadProductos += $item["cantidad"];

        $tipo = $item["tipo"];

        $id = intval($item["id"]);

    if($tipo=="producto"){

        $consulta = mysqli_query($conexion,"
            SELECT precio_descuento
            FROM productos
            WHERE id_producto=$id
        ");

    }else{

        $consulta = mysqli_query($conexion,"
            SELECT precio_descuento
            FROM combos
            WHERE id_combo=$id
        ");

    }

    if($fila=mysqli_fetch_assoc($consulta)){

        $total += $fila["precio_descuento"] * $item["cantidad"];

    }

}

?>

<div class="item" style="

background:#fff3e0;
border:2px solid orange;
border-radius:12px;
padding:25px;
box-shadow:0px 3px 8px rgba(0,0,0,.15);

">

    <div class="resumen-pedido">

    <h2>📦 Pedido listo para confirmar</h2>

    <p>

        🛒 <strong>Productos agregados:</strong>

        <?php echo $cantidadProductos; ?>

    </p>

    <p class="total">

        💰 S/<?php echo number_format($total,2); ?>

    </p>

    <hr>

    <p class="mensaje">

        Revise el detalle del pedido antes de confirmar la compra.

    </p>

</div>

</div>

<?php

}else{

    // Si el carrito está vacío no mostramos ningún mensaje.

}

?>

</div>


<?php

/*=====================================================
    Mostrar botones únicamente cuando existan productos
=====================================================*/

if (isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) > 0) {

?>

<a
    href="php/vaciar_carrito.php"
    class="btn-pedidos"
    style="background:#dc3545;">

    Vaciar Carrito

</a>

<br>

<button type="submit">

    Confirmar Pedido

</button>
<?php
}
?>



<br>

<!--======================================================
    BOTÓN PARA VER EL HISTORIAL DE PEDIDOS
=======================================================-->

<a href="pedidos.php" class="btn-pedidos">

    Pedidos Existentes

</a>

<!--=====================================================
    BOTÓN PARA VISUALIZAR EL DETALLE DEL PEDIDO

    Permitirá revisar todos los productos antes
    de confirmar la compra
======================================================-->

<button
    type="submit"
    formaction="pedido_resumen.php"
    class="btn-pedidos">

    👁 Visualizar Pedido

</button>

<p  id="mensajePedido" style="
    display:none;
    margin-top:12px;
    padding:12px;
    background:#fdecea;
    color:#c62828;
    border:1px solid #ef9a9a;
    border-radius:8px;
    text-align:center;
    font-weight:bold;
">

⚠ No hay productos en el carrito. Agregue al menos un producto antes de visualizar el pedido.

</p>

</form>

<!--======================================================
    ENLACES DE NAVEGACIÓN
=======================================================-->

<div class="enlaces">

    <a href="menu.php">
        <- Ir a Menú
    </a>
    |
    <a href="index.php">
        Inicio
    </a>
    |
    <a href="ofertas.php">
        Ir a Ofertas ->
    </a>

</div>

</div>

<!--======================================================
    SCRIPT DEL FORMULARIO
    Aquí se pueden realizar validaciones del lado
    del cliente usando JavaScript
    Ejemplos:
    - Validar dirección
    - Confirmar envío
    - Mostrar mensajes
=======================================================-->

<script src="js/form_pedido.js"></script>

<script src="js/modo.js"></script>

</body>

</html>
