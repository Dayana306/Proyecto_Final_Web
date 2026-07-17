<?php

session_start();
include("../conexion/conexion.php");

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION["id_usuario"])) {
    exit("Usuario no autenticado");
}

$id_usuario = $_SESSION["id_usuario"];
$modo = $_POST["modo"];

// Validar que solo pueda ser claro u oscuro
if ($modo != "claro" && $modo != "oscuro") {
    exit("Modo inválido");
}

// Actualizar en la base de datos
$sql = "UPDATE usuarios SET modo=? WHERE id_usuario=?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "si", $modo, $id_usuario);
mysqli_stmt_execute($stmt);

// Actualizar la sesión
$_SESSION["modo"] = $modo;

echo "ok";
?>