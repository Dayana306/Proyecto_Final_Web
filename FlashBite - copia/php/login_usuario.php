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

    header("Location: ../index.php");
    exit();

}else{

    echo "<h2>Correo o contraseña incorrectos.</h2>";

}