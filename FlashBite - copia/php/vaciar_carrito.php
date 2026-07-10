<?php
session_start();

if (isset($_SESSION["carrito"])) {
    unset($_SESSION["carrito"]);
}

header("Location: ../form_pedido.php");
exit();