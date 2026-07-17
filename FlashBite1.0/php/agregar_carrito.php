<?php
session_start();
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

$idProducto = 0;

$tipo = "producto";

if(isset($_POST["tipo"]) && isset($_POST["id"])){

    $tipo = $_POST["tipo"];

    $idProducto = intval($_POST["id"]);

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

            $item["cantidad"]++;

            $encontrado = true;

            break;

        }

    }

    unset($item);

    if(!$encontrado){

        $_SESSION["carrito"][] = [

            "tipo" => $tipo,

            "id" => $idProducto,

            "cantidad" => 1

        ];

    }

}
$paginaAnterior = $_SERVER["HTTP_REFERER"] ?? "../menu.php";

header("Location: " . $paginaAnterior);
exit();