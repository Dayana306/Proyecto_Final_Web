<?php

session_start();

include("../conexion/conexion.php");

if (
    !isset($_SESSION["carrito"]) ||
    empty($_SESSION["carrito"])
) {

    die("El carrito está vacío.");

}

if (
    !isset($_POST["direccion"]) ||
    trim($_POST["direccion"]) == ""
) {

    die("Debe ingresar una dirección.");

}

$direccion = trim($_POST["direccion"]);

if (!isset($_SESSION["id_usuario"])) {

    die("Debe iniciar sesión.");

}

$idUsuario = intval($_SESSION["id_usuario"]);

$sqlPedido = "

INSERT INTO pedidos(

    id_usuario,
    direccion_entrega

)

VALUES(

    '$idUsuario',
    '$direccion'

)

";

if (!mysqli_query($conexion, $sqlPedido)) {

    die(mysqli_error($conexion));

}

$idPedido = mysqli_insert_id($conexion);

$productosAgrupados = $_SESSION["carrito"];

foreach($productosAgrupados as $item){

    $tipo = $item["tipo"];

    $idProducto = intval($item["id"]);

    $cantidad = intval($item["cantidad"]);

    if($tipo=="producto"){

    $sqlProducto = "

        SELECT
            precio_descuento,
            stock
        FROM productos
        WHERE id_producto='$idProducto'

    ";

    }else{

    $sqlProducto = "

        SELECT
            precio_descuento,
            stock
        FROM combos
        WHERE id_combo='$idProducto'

    ";

}

    $resultado = mysqli_query($conexion, $sqlProducto);

    if (!$resultado) {

        die("Error al consultar el producto.");

    }

    if (mysqli_num_rows($resultado) == 0) {

        continue;

    }

    $producto = mysqli_fetch_assoc($resultado);

    $precio = $producto["precio_descuento"];
    $stock  = $producto["stock"];

    if ($stock < $cantidad) {

        die("No hay suficiente stock para completar el pedido.");

    }

    $sqlDetalle = "

    INSERT INTO detalle_pedido(

        id_pedido,
        id_producto,
        tipo,
        cantidad,
        precio

    )

    VALUES(

        '$idPedido',
        '$idProducto',
        '$tipo',
        '$cantidad',
        '$precio'

    )

";

if (!mysqli_query($conexion, $sqlDetalle)) {

    die(mysqli_error($conexion));

}

    $nuevoStock = $stock - $cantidad;

if($tipo=="producto"){

    $sqlStock = "

        UPDATE productos

        SET stock='$nuevoStock'

        WHERE id_producto='$idProducto'

    ";

}else{

    $sqlStock = "

        UPDATE combos

        SET stock='$nuevoStock'

        WHERE id_combo='$idProducto'

    ";

}

mysqli_query($conexion,$sqlStock);

}

unset($_SESSION["carrito"]);

header("Location: ../pedidos.php");

exit();

?>
