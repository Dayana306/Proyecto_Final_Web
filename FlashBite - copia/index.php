<?php
session_start();

require_once("conexion/conexion.php");

require_once("php/cargar_idioma.php");
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <link rel="icon" href="logo.jpeg" type="image/jpeg">

    <title>Flash Bite</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            background-color: #f2f2f2;
        }

        header{
            background-color: #ff914d;
            color: white;
            text-align: center;
            padding: 20px;
        }

        header img{
            width: 220px;
        }

        .titulo{
            font-family: 'Arial Black';
            font-size: 60px;
            color: #ffcca0;
            -webkit-text-stroke: 3px orangered;
            text-shadow: 3px 3px 0px #ff6600, 6px 6px 10px rgba(0,0,0,0.3);
            margin-bottom: 10px;
        }

        .subtitulo{
            font-size: 24px;
            color: white;
            font-weight: bold;
            }

        nav{
            background-color: orangered;
            padding: 15px;
            text-align: center;
        }

        nav a{
            color: white;
            text-decoration: none;
            margin: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        nav a:hover{
            color: yellow;
        }

        /* BOTÓN DE USUARIO */

        header{
            position:relative;
        }

        .btn-usuario{
            position:absolute;
            top:20px;
            right:20px;
            width:85px;
            height:85px;
            border-radius:50%;
            overflow:hidden;
            background:white;
            box-shadow:0 5px 15px rgba(0,0,0,0.3);
            transition:all 0.3s ease;
            z-index:1000;
            text-decoration:none;
        }

        .btn-usuario img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .btn-usuario:hover{
            transform:scale(1.1);
            box-shadow:0 8px 20px rgba(0,0,0,0.5);
        }

        .nombre-usuario{
            position:absolute;
            top:110px;
            right:10px;
            background:white;
            color:orangered;
            padding:6px 12px;
            border-radius:20px;
            font-size:14px;
            font-weight:bold;
            box-shadow:0 3px 10px rgba(0,0,0,0.2);
        }

        .contenido{
            text-align: center;
            padding: 40px;
        }

        .contenido h2{
            color: orangered;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            justify-content: center;
            justify-items: center;
            align-items: center;
            gap:20px;
            margin-top: 20px;
        }

        .card{
            background-color: white;
            width: 250px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
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

        .redes{
            display:flex;
            justify-content:center;
            gap:25px;
            flex-wrap:wrap;
            margin:20px 0;
        }

        .redes a{
            color:white;
            text-decoration:none;
            font-weight:bold;
            transition:0.3s;
        }

        .redes a:hover{
            color:#ff914d;
        }

        .copyright{
            margin-top:20px;
            color:#aaa;
            font-size:14px;
        }

        @media(max-width:1200px){
            .cards{
            grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:768px){
            .cards{
            grid-template-columns:1fr;
            }
            .footer-contenido{
            flex-direction:column;
            }
        }

        @media(max-width:480px){
            .carousel img{
            width:100%;
            }
        }

        /*CSS para el carrusel*/
        .carousel{
            width:100%;
            overflow:hidden;
            padding:20px 0;
        }

        /* Pista del carrusel */
        .carousel-track{
            display:flex;
            gap:20px;
            width:max-content;
            animation:scroll 20s linear infinite;
        }

        /* Pausar al pasar el mouse */
        .carousel-track:hover{
            animation-play-state:paused;
        }

        /* Imágenes */
        .carousel-track img{
            width:300px;
            height:200px;
            object-fit:cover;
            border-radius:12px;
            transition:0.3s;
            box-shadow:0 4px 10px rgba(0,0,0,0.3);
        }

        /* Efecto hover */
        .carousel-track img:hover{
            transform:translateY(-15px) scale(1.05);
            box-shadow:0 8px 20px rgba(0,0,0,0.5);
        }

        /* Animación infinita */
        @keyframes scroll{
            from{
                transform:translateX(0);
            }
            to{
                transform:translateX(-50%);
            }
        }

        /* Segundo carrusel (sentido contrario) */
        .carousel-reverse{
            width:100%;
            overflow:hidden;
            padding:20px 0;
        }

        .carousel-track-reverse{
            display:flex;
            gap:20px;
            width:max-content;
            animation:scrollReverse 20s linear infinite;
        }

        .carousel-track-reverse:hover{
            animation-play-state:paused;
        }

        .carousel-track-reverse img{
            width:300px;
            height:200px;
            object-fit:cover;
            border-radius:12px;
            transition:0.3s;
            box-shadow:0 4px 10px rgba(0,0,0,0.3);
        }

        .carousel-track-reverse img:hover{
            transform:translateY(-15px) scale(1.05);
            box-shadow:0 8px 20px rgba(0,0,0,0.5);
        }

        @keyframes scrollReverse{
            from{
                transform:translateX(-50%);
            }
            to{
                transform:translateX(0);
            }
        }

        /* Botón de usuario */
        .usuario{
            position:fixed;
            top:30px;
            right:30px;
            background:white;
            width:5px;
            height:5px;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:30px;
            text-decoration:none;
            box-shadow:0 0 10px rgba(0,0,0,0.3);
            z-index:1000;
            transition:0.3s;
        }

        .usuario:hover{
            transform:scale(1.1);
            background:#ffe0cc;
        }

        .btn-usuario{
            position:absolute;
            top:30px;
            right:30px;
            width:70px;
            height:70px;
            border-radius:50%;
            overflow:hidden;
            border:4px solid white;
            background:white;
            box-shadow:0 6px 20px rgba(0,0,0,0.35);
            transition:0.3s;
        }

        .btn-usuario:hover{
            transform:scale(1.12);
            border-color:#ffd54f;
        }

        .btn-usuario img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .nombre-usuario{
            position:absolute;
            top:120px;
            right:20px;
            width:90px;          /* mismo ancho que la foto */
            text-align:center;   /* centra el texto */
            background:white;
            color:orangered;
            padding:8px 0;
            border-radius:20px;
            font-size:14px;
            font-weight:bold;
            box-shadow:0 3px 10px rgba(0,0,0,0.2);
        }


        .estadisticas{
            display:flex;
            justify-content:center;
            gap:80px;
            margin:50px 0;
            text-align:center;
            flex-wrap:wrap;
        }

        .estadisticas h2{
            color:orangered;
            font-size:45px;
        }

        .testimonios{
            text-align:center;
            padding:50px 20px;
        }

        .testimonios h2{
            color:orangered;
            margin-bottom:30px;
        }

        .card{
            background:white;
            width:260px;
            padding:25px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-10px);
        }

        body{
            background:linear-gradient(
                180deg,
                #fff8f3,
                #ffe7d6
            );
        }

        /* MODO OSCURO  */
        .dark{
            background:#121212;
            color:white;
        }

        .dark header{
            background:#1b1b1b;
        }

        .dark nav{
            background:orangered;
        }

        .dark nav a{
            color:white;
        }

        .dark nav a:hover{
            color:#ff9800;
        }

        .dark .contenido{
            background:#121212;
        }

        .dark .contenido h2,
        .dark .titulo{
            color:#ff9800;
        }

        .dark .subtitulo{
            color:#dddddd;
        }

        .dark .card{
            background:#2b2b2b;
            color:white;
            box-shadow:0 0 15px rgba(0,0,0,.5);
        }

        .dark .card h3{
            color:#ff9800;
        }

        .dark .nombre-usuario{
            background:#2b2b2b;
            color:white;
        }

        .dark .btn-usuario{
            border:4px solid #ff9800;
            background:#2b2b2b;
        }

        .dark footer{
            background:#0f0f0f;
        }

        .dark .footer-contenido h2,
        .dark .footer-info h3{
            color:#ff9800;
        }

        .dark .footer-info p,
        .dark .copyright,
        .dark footer p{
            color:#dddddd;
        }

        .dark .redes a{
            color:white;
        }

        .dark .redes a:hover{
            color:#ff9800;
        }

        .dark hr{
            background:#444;
        }

        .dark .carousel-track img,
        .dark .carousel-track-reverse img{
            box-shadow:0 0 15px rgba(255,255,255,.15);
        }
    </style>

</head>

<body>
    
    <header>

        <a href="usuario.php" class="btn-usuario">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                alt="Usuario">
        </a>

        <div class="nombre-usuario">
            <span id="nombreUsuario">
                <?php echo $_SESSION["nombre"]; ?>
            </span>
        </div>

        <img src="gaga.gif" alt="Logo Flash Bite">

        <h1 class="titulo">
            FLASH <br> BITE
        </h1>

        <p class="subtitulo">
            Tu comida favorita al mejor precio
        </p>

    </header>

        <nav>

            <a href="menu.php"><?= $t["menu"] ?></a>

            <a href="pedidos.php"><?= $t["pedidos"] ?></a>

            <a href="ofertas.php"><?= $t["ofertas"] ?></a>

        </nav>

        <section class="contenido">

            <h2><?= $t["bienvenido"] ?></h2>

            <p>
                Flash Bite es una plataforma creada para ayudar a reducir
                el desperdicio de alimentos, ofreciendo comidas de calidad
                a precios accesibles.
            </p>

            <div class="cards">

                <div class="card">
                    <h3>🍕 Menú Variado</h3>

                    <p>
                        Encuentra diferentes platos y promociones.
                    </p>

                </div>

                <div class="card">
                    <h3>🥗 Rescate de Alimentos</h3>

                    <p>
                        Ayudamos a evitar el desperdicio de comida.
                    </p>

                </div>

                <div class="card">
                    <h3>🚚 Pedidos Rápidos</h3>

                    <p>
                        Realiza tus pedidos de forma fácil y rápida.
                    </p>

                </div>

            </div>

        </section>

        <!--Carrrusel-->
        <div class="carousel">
            <div class="carousel-track">

                <img src="https://th.bing.com/th/id/OIP.yO6SbPgjHgCHW4o2LOh1GQHaE7?w=248&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 1">
                <img src="https://th.bing.com/th/id/OIP.OSINhMR4SBGzitjZ8SKLEgHaEK?w=333&h=187&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 2">
                <img src="https://th.bing.com/th/id/OIP.ufBGfQHPxdOj7tCwGqx05wHaEK?w=324&h=182&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 3">
                <img src="https://th.bing.com/th/id/OIP.Uf1E5GpVICXkNlEJoIvZnwHaC2?w=334&h=134&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 4">
                <img src="https://th.bing.com/th/id/OIP.Hq_1unSSakgNZmzHv5L8kwHaLK?w=115&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 5">

                <img src="https://th.bing.com/th/id/OIP.yO6SbPgjHgCHW4o2LOh1GQHaE7?w=248&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 1">
                <img src="https://th.bing.com/th/id/OIP.OSINhMR4SBGzitjZ8SKLEgHaEK?w=333&h=187&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 2">
                <img src="https://th.bing.com/th/id/OIP.ufBGfQHPxdOj7tCwGqx05wHaEK?w=324&h=182&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 3">
                <img src="https://th.bing.com/th/id/OIP.Uf1E5GpVICXkNlEJoIvZnwHaC2?w=334&h=134&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 4">
                <img src="https://th.bing.com/th/id/OIP.Hq_1unSSakgNZmzHv5L8kwHaLK?w=115&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="Imagen 5">

            </div>
        </div>

        <div class="carousel-reverse">
        <div class="carousel-track-reverse">

            <img src="https://th.bing.com/th/id/OIP.yO6SbPgjHgCHW4o2LOh1GQHaE7?w=248&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">
            <img src="https://th.bing.com/th/id/OIP.OSINhMR4SBGzitjZ8SKLEgHaEK?w=333&h=187&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">
            <img src="https://th.bing.com/th/id/OIP.ufBGfQHPxdOj7tCwGqx05wHaEK?w=324&h=182&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">
            <img src="https://th.bing.com/th/id/OIP.Uf1E5GpVICXkNlEJoIvZnwHaC2?w=334&h=134&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">
            <img src="https://th.bing.com/th/id/OIP.Hq_1unSSakgNZmzHv5L8kwHaLK?w=115&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">

            <!-- Repetidas para efecto infinito -->
            <img src="https://th.bing.com/th/id/OIP.yO6SbPgjHgCHW4o2LOh1GQHaE7?w=248&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">
            <img src="https://th.bing.com/th/id/OIP.OSINhMR4SBGzitjZ8SKLEgHaEK?w=333&h=187&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">
            <img src="https://th.bing.com/th/id/OIP.ufBGfQHPxdOj7tCwGqx05wHaEK?w=324&h=182&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">
            <img src="https://th.bing.com/th/id/OIP.Uf1E5GpVICXkNlEJoIvZnwHaC2?w=334&h=134&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">
            <img src="https://th.bing.com/th/id/OIP.Hq_1unSSakgNZmzHv5L8kwHaLK?w=115&h=180&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" alt="">

        </div>
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
                    <h3> <?= $t["contacto"] ?></h3>
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

    <script src="js/index.js"></script>

</body>

</html>