<?php

session_start();

include("../conexion/conexion.php");

if(!isset($_SESSION["id_usuario"])){
    header("Location: ../login.html");
    exit();
}

$id_usuario = $_SESSION["id_usuario"];

$nombre = trim($_POST["nombre"]);
$telefono = trim($_POST["telefono"]);
$metodo_pago = trim($_POST["metodo_pago"]);
$cuenta_pago = trim($_POST["cuenta_pago"]);

// Validar teléfono
if(!preg_match('/^[0-9]{9}$/', $telefono)){
    die("El teléfono debe tener exactamente 9 dígitos.");
}

// Validar Yape y Plin
if(
    ($metodo_pago=="Yape" || $metodo_pago=="Plin") &&
    !preg_match('/^[0-9]{9}$/', $cuenta_pago)
){
    die("Yape o Plin deben tener exactamente 9 dígitos.");
}

// Validar Visa y Mastercard
if(
    ($metodo_pago=="Visa" || $metodo_pago=="Mastercard") &&
    !preg_match('/^[0-9]{16}$/', $cuenta_pago)
){
    die("La tarjeta debe tener exactamente 16 dígitos.");
}

$sql = "UPDATE usuarios
SET
nombre='$nombre',
telefono='$telefono',
metodo_pago='$metodo_pago',
cuenta_pago='$cuenta_pago'
WHERE id_usuario='$id_usuario'";

if(mysqli_query($conexion,$sql)){

    $_SESSION["nombre"] = $nombre;

    header("Location: ../usuario.php");
    exit();

}else{

    echo "Error: ".mysqli_error($conexion);

}

?>