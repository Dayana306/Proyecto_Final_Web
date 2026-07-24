<?php
/*====================================================
    USUARIO.PHP
====================================================*/

// Iniciar sesión
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.html");
    exit();
}

// Conexión a la base de datos
require_once("conexion/conexion.php");

$id_usuario = $_SESSION["id_usuario"];

$sql_usuario = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";

$resultado_usuario = mysqli_query($conexion, $sql_usuario);

$datos_usuario = mysqli_fetch_assoc($resultado_usuario);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

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
            transition:0.3s;
        }

        header{
            background:orangered;
            color:white;
            padding:15px 30px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            font-size:28px;
            font-weight:bold;
        }

        .usuario-header{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .usuario-header img{
            width:50px;
            height:50px;
            border-radius:50%;
        }

        .modo-btn{
            border:none;
            background:white;
            width:45px;
            height:45px;
            border-radius:50%;
            cursor:pointer;
            font-size:20px;
        }

        .container{
            max-width:1200px;
            margin:auto;
            padding:30px;
        }

        .perfil{
            background:white;
            border-radius:15px;
            padding:30px;
            text-align:center;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            display:flex;
            flex-direction:column;
            align-items:center;
        }

        .perfil img{
            width:130px;
            height:130px;
            border-radius:50%;
            border:4px solid orangered;
        }

        .perfil h2{
            margin-top:15px;
        }

        .perfil p{
            color:gray;
            margin-top:5px;
        }

        .menu{
            margin-top:30px;
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .card h3{
            color:orangered;
            margin-bottom:10px;
        }

        .btn{
            display:inline-block;
            margin-top:15px;
            background:orangered;
            color:white;
            text-decoration:none;
            padding:10px 20px;
            border-radius:8px;
            border:none;
            cursor:pointer;
        }

        .btn:hover{
            background:#d84315;
        }

        .cerrar{
            background:#dc3545;
        }

        .cerrar:hover{
            background:#b02a37;
        }


        footer{
            background:#1f1f1f;
            color:white;
            padding:50px 20px;
            margin-top:50px;
        }

        .footer-contenido{
            max-width:1200px;
            margin:auto;
            text-align:center;
        }

        .footer-contenido h2{
            color:#ff914d;
            margin-bottom:15px;
        }

        .footer-contenido hr{
            border:none;
            height:1px;
            background:#444;
            margin:25px 0;
        }

        .footer-info{
            display:flex;
            justify-content:space-around;
            gap:30px;
            flex-wrap:wrap;
            text-align:left;
        }

        .footer-info h3{
            color:#ff914d;
            margin-bottom:10px;
        }

        .footer-info p{
            line-height:1.8;
        }

        /* MODO OSCURO */
        .dark{
            background:#1a1a1a;
            color:white;
        }

        .dark .perfil,
        .dark .card{
            background:#2c2c2c;
            color:white;
        }

        .dark .perfil p{
            color:#ddd;
        }

        .dark footer{
            background:black;
        }

            footer{
            background:#1f1f1f;
            color:white;
            padding:50px 20px;
            margin-top:50px;
        }

        .footer-contenido{
            max-width:1200px;
            margin:auto;
            text-align:center;
        

        }

        .footer-contenido h2{
            color:#ff914d;
            margin-bottom:15px;
        }

        .footer-contenido hr{
            border:none;
            height:1px;
            background:#444;
            margin:25px 0;
        }

        .footer-info{
            display:flex;
            justify-content:space-around;
            gap:30px;
            flex-wrap:wrap;
            text-align:left;
        }

        .footer-info h3{
            color:#ff914d;
            margin-bottom:10px;
        }

        .footer-info p{
            line-height:1.8;
        }

        @media(max-width:1200px){
            .menu{
            grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:768px){
            .menu{
            grid-template-columns:1fr;
            }
        }

        @media(max-width:480px){
            .container{
            padding:15px;
            }
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

        .contenido-modal{

            background:white;
            width:420px;
            padding:30px;
            border-radius:15px;

        }

        .contenido-modal input,
        .contenido-modal select{

            width:100%;
            padding:10px;
            margin-top:10px;
            margin-bottom:15px;

        }

        .dark .contenido-modal{

            background:#2c2c2c;
            color:white;

        }

    </style>
</head>
<body class="<?php echo ($datos_usuario["modo"] == "oscuro") ? "dark" : ""; ?>">
    <header>

        <div class="logo">
            Flash Bite
        </div>

        <div class="usuario-header">

            <button id="modoOscuro" class="modo-btn">
                🌙
            </button>

            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

            <span>
                <?php echo $_SESSION["nombre"]; ?>
            </span>

        </div>

    </header>

    <div class="container">

        <div class="perfil">

            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

            <h2>
                <?php echo $_SESSION["nombre"]; ?>
            </h2>

            <p>
                <?php echo $_SESSION["correo"]; ?>
            </p>

            <p id="telefono">

                Teléfono:
                <?php 
                    echo $datos_usuario["telefono"] 
                    ? $datos_usuario["telefono"] 
                    : "No registrado";
                ?>

            </p>

            <p id="metodo">

                Método de pago:
                <?php 
                    echo $datos_usuario["metodo_pago"] 
                    ? $datos_usuario["metodo_pago"] 
                    : "No registrado";
                ?>

            </p>

            <p id="cuenta">

                Cuenta:
                <?php 
                    echo $datos_usuario["cuenta_pago"] 
                    ? $datos_usuario["cuenta_pago"] 
                    : "No registrada";
                ?>

            </p>

            <p>

            Miembro de Flash Bite desde:

            <br>

            <?php

            echo date(
                "d/m/Y H:i",
                strtotime($datos_usuario["fecha_registro"])
            );

            ?>

            </p>

            <button class="btn" onclick="editarPerfil()">
                Editar perfil
            </button>

        </div>

        <div class="menu">

            <div class="card">
                <h3>Mis pedidos</h3>
                <p>Consulta el historial de tus pedidos</p>
                <a href="pedidos.php" class="btn">
                    Ver pedidos
                </a>
            </div>

            <div class="card">
                <h3>Ajustes</h3>
                <p>Configuración de la cuenta</p>
                <a href="ajustes.php" class="btn">
                    Ajustes
                </a>
            </div>

            <div class="card">
                <h3>Cerrar sesión</h3>
                <p>Salir de tu cuenta</p>

                <button class="btn cerrar"
                        onclick="cerrarSesion()">
                    Cerrar sesión
                </button>
            </div>

        </div>
                <a href="index.php" class="btn">
                   Volver
                </a>
    </div>


    <footer>

        <div class="footer-contenido">

            <h2>🍔 Flash Bite</h2>

            <p>
                Plataforma dedicada al rescate de alimentos y promociones
                de restaurantes asociados en Mall Aventura Arequipa.
            </p>

            <hr>

            <div class="footer-info">

                <div>
                    <h3>Ubicación</h3>
                    <p>
                        Mall Aventura Arequipa<br>
                        Av. Porongoche 500<br>
                        Arequipa - Perú
                    </p>
                </div>

                <div>
                    <h3>🍕 Restaurantes Asociados</h3>
                    <p>
                        KFC • Bembos • Burger King<br>
                        Pizza Hut • Chinawok<br>
                        y más aliados comerciales
                    </p>
                </div>

                <div>
                    <h3>Contacto</h3>
                    <p>
                        contacto@flashbite.com<br>
                        +51 900 123 456
                    </p>
                </div>
            </div>
            <hr>
            <div class="redes">
                <a href="#">📷 Instagram</a>
                <a href="#">👍 Facebook</a>
                <a href="#">🎵 TikTok</a>
                <a href="#">📧 Correo</a>
            </div>

            <p class="copyright">
                © 2026 Flash Bite. Todos los derechos reservados.
            </p>

        </div>

    </footer>


    <div id="modalEditar" class="modal">

    <div class="contenido-modal">

        <h2>Editar Perfil</h2>

        <form id="formEditar" action="php/editar_usuario.php" method="POST">

            <input
                type="text"
                id="editarNombre"
                name="nombre"
                value="<?php echo $datos_usuario['nombre']; ?>"
                required>

            <input
                type="tel"
                id="editarTelefono"
                name="telefono"
                value="<?php echo $datos_usuario['telefono']; ?>"
                maxlength="9"
                required>

            <select id="editarMetodo" name="metodo_pago">

                <option value="Yape" <?php if($datos_usuario["metodo_pago"]=="Yape") echo "selected"; ?>>Yape</option>

                <option value="Plin" <?php if($datos_usuario["metodo_pago"]=="Plin") echo "selected"; ?>>Plin</option>

                <option value="Visa" <?php if($datos_usuario["metodo_pago"]=="Visa") echo "selected"; ?>>Visa</option>

                <option value="Mastercard" <?php if($datos_usuario["metodo_pago"]=="Mastercard") echo "selected"; ?>>Mastercard</option>

            </select>

            <input
                id="editarCuenta"
                type="text"
                name="cuenta_pago"
                value="<?php echo $datos_usuario["cuenta_pago"]; ?>"
                required>

                <p id="mensajeEditar" style="color:red;font-weight:bold;margin-bottom:15px;"></p>

            <br><br>

            <button class="btn" type="submit">

                Guardar cambios

            </button>

            <button
                type="button"
                class="btn cerrar"
                onclick="cerrarModal()">

                Cancelar

            </button>

        </form>

    </div>

</div>
    
    <script src="js/usuario.js"></script>

</body>
</html>
