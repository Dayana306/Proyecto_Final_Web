<?php

include("../conexion/conexion.php");

$correo = trim($_POST["correo"]);
$password = $_POST["password"];
$password2 = $_POST["password2"];

if($password != $password2){

    die("Las contraseñas no coinciden.");

}

$sql = "SELECT * FROM usuarios WHERE correo='$correo'";

$resultado = mysqli_query($conexion,$sql);

if(mysqli_num_rows($resultado)==0){

    die("El correo no está registrado.");

}

$sqlActualizar = "UPDATE usuarios
SET contraseña='$password'
WHERE correo='$correo'";

if(mysqli_query($conexion,$sqlActualizar)){

    header("Location: ../login.html?recuperado=1");
    exit();

}else{

    echo "Error: ".mysqli_error($conexion);

}

?>