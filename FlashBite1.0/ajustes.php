<?php
/*====================================================
    AJUSTES.PHP
    Configuración de la cuenta
====================================================*/

// Iniciar sesión
session_start();

$modo = "claro";

if (isset($_SESSION["modo"])) {
    $modo = $_SESSION["modo"];
}

// Conectar con la base de datos
require_once("conexion/conexion.php");

// Verificar si el usuario inició sesión
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.html");
    exit();
}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Flash Bite</title>

<link rel="icon" href="logo.jpeg" type="image/jpeg">

<style>


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, Helvetica, sans-serif;
    background:#f5f5f5;
}

header{
    background:orangered;
    color:white;
    padding:18px;
    text-align:center;
}

.container{
    max-width:700px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 10px rgba(0,0,0,.2);
}

h2{
    color:orangered;
    margin-bottom:25px;
}

.opcion{
    margin-bottom:35px;
}

label{
    font-weight:bold;
    display:block;
    margin-bottom:10px;
}

select{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:16px;
}

button{
    padding:12px 25px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

.eliminar{
    background:#dc3545;
    color:white;
}

.eliminar:hover{
    background:#b02a37;
}

.volver{
    background:orangered;
    color:white;
    text-decoration:none;
    padding:12px 25px;
    border-radius:8px;
    display:inline-block;
    margin-top:20px;
}

.modal{
    display:none;
    position:fixed;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.5);
    justify-content:center;
    align-items:center;
}

.modal-contenido{
    background:white;
    padding:30px;
    border-radius:15px;
    width:350px;
    text-align:center;
}

.modal-contenido h3{
    margin-bottom:20px;
}

.botones{
    display:flex;
    justify-content:space-around;
    margin-top:20px;
}

.aceptar{
    background:#dc3545;
    color:white;
}

.cancelar{
    background:gray;
    color:white;
}

/*==========================
        MODO OSCURO
==========================*/

.dark{
    background:#121212;
    color:white;
}

.dark header{
    background:orangered;
}

.dark .container{
    background:#2b2b2b;
}

.dark h2,
.dark label{
    color:#ff9800;
}

.dark select{
    background:#1f1f1f;
    color:white;
    border:1px solid #555;
}

.dark .modal-contenido{
    background:#2b2b2b;
    color:white;
}

</style>

</head>

<body class="<?= ($modo == "oscuro") ? "dark" : "" ?>">

<!--=========================================
    ENCABEZADO
==========================================-->

<header>

<h1>Ajustes</h1>

</header>

<!--=========================================
    CONTENEDOR PRINCIPAL
==========================================-->

<div class="container">

    <h2>Configuración de la cuenta</h2>

    <!--=====================================
        ELIMINAR CUENTA
    ======================================-->

    <div class="opcion">

        <label>Eliminar cuenta</label>

        <button
            class="eliminar"
            type="button"
            onclick="eliminarCuenta()">

            Eliminar cuenta

        </button>

    </div>

    <!--=====================================
        BOTÓN VOLVER
    ======================================-->

    <a href="usuario.php" class="volver">

        Volver

    </a>

</div>

<!--=========================================
    JAVASCRIPT
==========================================-->

<script src="js/ajustes.js"></script>

</body>

</html>