<?php

session_start();

include("../conexion/conexion.php");

$correo = $_POST["correo"];
$password = $_POST["password"];

$sql = "SELECT * FROM usuarios
        WHERE correo='$correo'
        AND contraseña='$password'";

$resultado = mysqli_query($conexion,$sql);

if(mysqli_num_rows($resultado)>0){

    $usuario = mysqli_fetch_assoc($resultado);

    $_SESSION["id_usuario"] = $usuario["id_usuario"];
    $_SESSION["nombre"] = $usuario["nombre"];
    $_SESSION["correo"] = $usuario["correo"];
    $_SESSION["modo"] = $usuario["modo"];

    header("Location: ../index.php");
    exit();

}else{

    header("Location: ../login.html?error=1");
    exit();

}