<?php

session_start();

if(!isset($_SESSION["carrito"])){

    header("Location: ../pedido_resumen.php");
    exit();

}

if(isset($_GET["indice"]) && isset($_GET["accion"])){

    $indice = intval($_GET["indice"]);
    $accion = $_GET["accion"];

    if(isset($_SESSION["carrito"][$indice])){

        switch($accion){

            case "sumar":

                $tipo = $_SESSION["carrito"][$indice]["tipo"];
                $id = $_SESSION["carrito"][$indice]["id"];

                include("../conexion/conexion.php");

                if($tipo=="producto"){

                    $sql = "SELECT stock
                            FROM productos
                            WHERE id_producto='$id'";

                }else{

                    $sql = "SELECT stock
                            FROM combos
                            WHERE id_combo='$id'";

                }

                $resultado = mysqli_query($conexion,$sql);

                if($fila=mysqli_fetch_assoc($resultado)){

                    if($_SESSION["carrito"][$indice]["cantidad"] < $fila["stock"]){

                        $_SESSION["carrito"][$indice]["cantidad"]++;

                }else{

                    $_SESSION["mensaje_stock"] = "⚠ Solo quedan ".$fila["stock"]." unidades disponibles.";

                }

                }

            break;

            case "restar":

                $_SESSION["carrito"][$indice]["cantidad"]--;

                if($_SESSION["carrito"][$indice]["cantidad"]<=0){

                    unset($_SESSION["carrito"][$indice]);

                    $_SESSION["carrito"]=array_values($_SESSION["carrito"]);

                }

            break;

            case "eliminar":

                unset($_SESSION["carrito"][$indice]);

                $_SESSION["carrito"] = array_values($_SESSION["carrito"]);

            break;

        }

    }

}

header("Location: ../pedido_resumen.php");
exit();

?>