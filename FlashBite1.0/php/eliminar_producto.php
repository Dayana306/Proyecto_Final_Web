<?php

session_start();

if(isset($_GET["indice"])){

    $indice = intval($_GET["indice"]);

    if(isset($_SESSION["carrito"][$indice])){

        unset($_SESSION["carrito"][$indice]);

        // Reorganizar índices del carrito
        $_SESSION["carrito"] = array_values($_SESSION["carrito"]);

    }

}

header("Location: ../pedido_resumen.php");
exit();

?>