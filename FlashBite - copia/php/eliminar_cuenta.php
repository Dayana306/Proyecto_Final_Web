<?php

session_start();

require_once("../conexion/conexion.php");


if(!isset($_SESSION["id_usuario"])){

    echo json_encode([
        "ok"=>false,
        "error"=>"No existe una sesión."
    ]);

    exit();

}

$id=$_SESSION["id_usuario"];

$sql="DELETE FROM usuarios WHERE id=?";

$stmt=$conexion->prepare($sql);

$stmt->bind_param("i",$id);

if($stmt->execute()){

    session_destroy();

    echo json_encode([
        "ok"=>true
    ]);

}else{

    echo json_encode([
        "ok"=>false,
        "error"=>"No fue posible eliminar la cuenta."
    ]);

}
?>