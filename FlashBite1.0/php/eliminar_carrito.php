<?php
session_start();

if (isset($_GET["pos"])) {

    $posicion = intval($_GET["pos"]);

    if (isset($_SESSION["carrito"][$posicion])) {

        unset($_SESSION["carrito"][$posicion]);

        $_SESSION["carrito"] = array_values($_SESSION["carrito"]);
    }
}

header("Location: ../form_pedido.php");
exit();