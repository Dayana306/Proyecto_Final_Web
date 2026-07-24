<?php
session_start();

unset($_SESSION["carrito"]);

header("Location: ../form_pedido.php");
exit();
?>