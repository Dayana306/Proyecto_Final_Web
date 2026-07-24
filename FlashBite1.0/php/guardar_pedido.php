<?php

session_start();
include("../conexion/conexion.php");

/*=========================================================
    VALIDAR CARRITO
=========================================================*/

if (!isset($_SESSION["carrito"]) || empty($_SESSION["carrito"])) {
    die("El carrito está vacío.");
}

/*=========================================================
    VALIDAR DIRECCIÓN
=========================================================*/

if (!isset($_POST["direccion"]) || trim($_POST["direccion"]) == "") {
    die("Debe ingresar una dirección.");
}

$direccion = trim($_POST["direccion"]);

/*=========================================================
    VALIDAR SESIÓN
=========================================================*/

if (!isset($_SESSION["id_usuario"])) {
    die("Debe iniciar sesión.");
}

$idUsuario = intval($_SESSION["id_usuario"]);

/*=========================================================
    GUARDAR PEDIDO
=========================================================*/

$sqlPedido = "
INSERT INTO pedidos(
    id_usuario,
    direccion_entrega
)
VALUES(
    '$idUsuario',
    '$direccion'
)";

if (!mysqli_query($conexion, $sqlPedido)) {
    die("Error al guardar el pedido: " . mysqli_error($conexion));
}

$idPedido = mysqli_insert_id($conexion);

/*=========================================================
    RECORRER CARRITO
=========================================================*/

foreach ($_SESSION["carrito"] as $item) {

    $tipo = $item["tipo"];
    $idProducto = intval($item["id"]);
    $cantidad = intval($item["cantidad"]);

    if ($tipo == "producto") {

        $sqlProducto = "
        SELECT precio_descuento, stock
        FROM productos
        WHERE id_producto='$idProducto'";

    } else {

        $sqlProducto = "
        SELECT precio_descuento, stock
        FROM combos
        WHERE id_combo='$idProducto'";

    }

    $resultado = mysqli_query($conexion, $sqlProducto);

    if (!$resultado) {
        die(mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado) == 0) {
        continue;
    }

    $producto = mysqli_fetch_assoc($resultado);

    $precio = $producto["precio_descuento"];
    $stock = $producto["stock"];

    if ($stock < $cantidad) {
        die("No hay suficiente stock para completar el pedido.");
    }

    /*=====================================================
        GUARDAR DETALLE DEL PEDIDO
    =====================================================*/

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
    )";

    if (!mysqli_query($conexion, $sqlDetalle)) {
        die("Error al guardar detalle: " . mysqli_error($conexion));
    }

    /*=====================================================
        DESCONTAR STOCK
    =====================================================*/

    if ($tipo == "producto") {

        $sqlStock = "
        UPDATE productos
        SET stock = stock - $cantidad
        WHERE id_producto='$idProducto'";

    } else {

        $sqlStock = "
        UPDATE combos
        SET stock = stock - $cantidad
        WHERE id_combo='$idProducto'";

    }

    if (!mysqli_query($conexion, $sqlStock)) {
        die(mysqli_error($conexion));
    }
}

/*=========================================================
    LIMPIAR CARRITO
=========================================================*/

unset($_SESSION["carrito"]);

/*=========================================================
    REDIRECCIONAR
=========================================================*/

header("Location: ../pedidos.php");
exit();

?>