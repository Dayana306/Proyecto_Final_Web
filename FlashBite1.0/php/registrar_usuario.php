<?php

header('Content-Type: application/json');

mysqli_report(MYSQLI_REPORT_OFF);

include("../conexion/conexion.php");

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$password = $_POST["password"];
$confirmar = $_POST["confirmar"];

$metodo_pago = $_POST["metodo_pago"];
$cuenta_pago = $_POST["cuenta_pago"];

$direccion = "No registrada";

// Validar que las contraseñas coincidan
if ($password !== $confirmar) {
    echo json_encode([
        "ok" => false,
        "mensaje" => "Las contraseñas no coinciden."
    ]);
    exit();
}

// Validar teléfono
if(!preg_match('/^[0-9]{9}$/', $telefono)){

    echo json_encode([
        "ok"=>false,
        "mensaje"=>"El teléfono debe tener exactamente 9 dígitos."
    ]);

    exit();
}

// Validar Yape o Plin
if (
    ($metodo_pago == "Yape" || $metodo_pago == "Plin") &&
    !preg_match('/^[0-9]{9}$/', $cuenta_pago)
) {

    echo json_encode([
        "ok" => false,
        "mensaje" => "El número de Yape o Plin debe tener exactamente 9 dígitos."
    ]);

    exit();
}

// Validar tarjetas
if (
    ($metodo_pago == "Visa" || $metodo_pago == "Mastercard") &&
    !preg_match('/^[0-9]{16}$/', $cuenta_pago)
) {

    echo json_encode([
        "ok" => false,
        "mensaje" => "La tarjeta debe tener exactamente 16 dígitos."
    ]);

    exit();
}

// Verificar si el correo ya existe
$consulta = "SELECT id_usuario FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {

    echo json_encode([
        "ok" => false,
        "mensaje" => "El correo ya está registrado."
    ]);

    exit();
}

$sql = "INSERT INTO usuarios
(nombre,correo,contraseña,telefono,direccion,metodo_pago,cuenta_pago)

VALUES

('$nombre','$correo','$password','$telefono','$direccion','$metodo_pago','$cuenta_pago')";

if (mysqli_query($conexion, $sql)) {

    echo json_encode([
        "ok" => true,
        "mensaje" => "Usuario registrado correctamente."
    ]);

} else {

    echo json_encode([
        "ok" => false,
        "mensaje" => "No se pudo registrar el usuario."
    ]);

}

?>