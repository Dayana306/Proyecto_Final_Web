<?php

session_start();

include("../conexion/conexion.php");

$correo = $_POST["correo"];
$password = $_POST["password"];

if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){

    header("Location: ../login.html?error=1");

    exit();

}

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");

$stmt->bind_param("s", $correo);

$stmt->execute();

$resultado = $stmt->get_result();

if(mysqli_num_rows($resultado)>0){

    $usuario = mysqli_fetch_assoc($resultado);

    if(password_verify($password, $usuario["contraseña"])){

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

}else{

    header("Location: ../login.html?error=1");
    exit();

}