<?php
session_start();
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

$idProducto = 0;
$cantidad = 1;

$tipo = "producto";

if(isset($_POST["tipo"]) && isset($_POST["id"])){

    $tipo = $_POST["tipo"];

    $idProducto = intval($_POST["id"]);

    if(isset($_POST["cantidad"])){

        $cantidad = intval($_POST["cantidad"]);

        if($cantidad < 1){

            $cantidad = 1;

        }

    }

}

elseif(isset($_GET["id"])){

    $tipo = "producto";

    $idProducto = intval($_GET["id"]);

}

if($idProducto > 0){

    $encontrado = false;

    foreach($_SESSION["carrito"] as &$item){

        if(
            $item["tipo"] == $tipo &&
            $item["id"] == $idProducto
        ){

            $item["cantidad"] = $cantidad;

            $encontrado = true;

            break;

        }

    }

    unset($item);

    if(!$encontrado){

        $_SESSION["carrito"][] = [

            "tipo" => $tipo,

            "id" => $idProducto,

            "cantidad" => $cantidad

        ];

    }

}

include("../conexion/conexion.php");



$paginaAnterior = $_SERVER["HTTP_REFERER"] ?? "../menu.php";

header("Location: " . $paginaAnterior);
exit();