<?php
$idioma = "es";

if (isset($_SESSION["id_usuario"])) {

    $sql = "SELECT idioma
            FROM usuarios
            WHERE id_usuario = ?";

    $stmt = $conexion->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("i", $_SESSION["id_usuario"]);

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {

            $usuario = $resultado->fetch_assoc();

            if (!empty($usuario["idioma"])) {

                $idioma = $usuario["idioma"];

            }

        }

    }

}

require_once(__DIR__ . "/idiomas.php");

if (!isset($traducciones[$idioma])) {

    $idioma = "es";

}

$t = $traducciones[$idioma];