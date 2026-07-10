<?php

include("../conexion/conexion.php");

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$password = $_POST["password"];


$direccion = "No registrada";

$sql = "INSERT INTO usuarios
(nombre,correo,contraseña,telefono,direccion)

VALUES

('$nombre','$correo','$password','$telefono','$direccion')";

if(mysqli_query($conexion,$sql)){

    header("Location: ../login.html");

}else{

    echo "Error al registrar: ".mysqli_error($conexion);

}

?>