<?php

$servidor = "localhost";  
$usuario = "root"; 
$password = "";  
$bd = "flashbite"; 

$conexion = mysqli_connect(  
    $servidor,
    $usuario,
    $password,
    $bd
);

if(!$conexion){  

    die("Error de conexión: " . mysqli_connect_error());  
}

mysqli_set_charset($conexion,"utf8"); 

?>