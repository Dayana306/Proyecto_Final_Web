<?php
session_start();

require_once("../conexion/conexion.php");

if (!isset($_SESSION["id_usuario"])) {

    echo json_encode([
        "ok" => false,
        "error" => "No hay sesión."
    ]);

    exit();
}


if (!isset($_POST["idioma"])) {

    echo json_encode([
        "ok" => false,
        "error" => "Idioma no recibido."
    ]);

    exit();
}

$idioma = trim($_POST["idioma"]);

$idiomasPermitidos = ["es", "en", "pt", "fr", "zh"];

if (!in_array($idioma, $idiomasPermitidos)) {

    $idioma = "es";

}

$id = $_SESSION["id_usuario"];

$sql = "UPDATE usuarios
        SET idioma=?
        WHERE id_usuario=?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("si", $idioma, $id);

if ($stmt->execute()) {

    echo json_encode([
        "ok" => true
    ]);

} else {

    echo json_encode([
        "ok" => false,
        "error" => "No se pudo guardar."
    ]);

}