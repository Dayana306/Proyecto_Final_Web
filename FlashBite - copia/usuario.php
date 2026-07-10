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

// Cargar el idioma del usuario
require_once("php/cargar_idioma.php");
?>


<!DOCTYPE html>
<html lang="<?= $idioma ?>">
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

    </style>
</head>
<body>
    <header>

        <div class="logo">
            Flash Bite
        </div>

        <div class="usuario-header">

            <button onclick="cambiarModo()" class="modo-btn">
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
                <?= $t["telefono"] ?>
            </p>

            <p id="metodo">
                <?= $t["metodo_pago"] ?>
            </p>

            <p id="cuenta">
                <?= $t["cuenta"] ?>
            </p>

            <p>
                <?= $t["miembro"] ?>
            </p>

            <button class="btn" onclick="editarPerfil()">
                <?= $t["editar_perfil"] ?>
            </button>

        </div>

        <div class="menu">

            <div class="card">
                <h3><?= $t["mis_pedidos"] ?></h3>
                <p><?= $t["historial_pedidos"] ?></p>
                <a href="pedidos.php" class="btn">
                    <?= $t["ver_pedidos"] ?>
                </a>
            </div>

            <div class="card">
                <h3><?= $t["ajustes"] ?></h3>
                <p><?= $t["configuracion"] ?></p>
                <a href="ajustes.php" class="btn">
                    <?= $t["ajustes"] ?>
                </a>
            </div>

            <div class="card">
                <h3><?= $t["cerrar_sesion"] ?></h3>
                <p><?= $t["salir_cuenta"] ?></p>

                <button class="btn cerrar"
                        onclick="cerrarSesion()">
                    <?= $t["cerrar_sesion"] ?>
                </button>
            </div>

        </div>
                <a href="index.php" class="btn">
                   <?= $t["volver"] ?>
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
                    <h3><?= $t["ubicacion"] ?></h3>
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
                    <h3><?= $t["contacto"] ?></h3>
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
                <?= $t["derechos"] ?>
            </p>

        </div>

    </footer>
    
    <script src="js/usuario.js"></script>

</body>
</html>
