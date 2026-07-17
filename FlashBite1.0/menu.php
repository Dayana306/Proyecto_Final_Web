<?php

session_start();

$modo = "claro";

if (isset($_SESSION["modo"])) {
    $modo = $_SESSION["modo"];
}

/*=========================================
    Contar productos del carrito
==========================================*/
$contador = 0;

if(isset($_SESSION["carrito"])){

    $contador = count($_SESSION["carrito"]);

}


include("conexion/conexion.php");

/*=========================================
    Obtener todos los productos
==========================================*/

$sql = "

SELECT *

FROM productos

WHERE es_oferta = 0

AND stock > 0

ORDER BY nombre ASC

";



$resultado = mysqli_query($conexion,$sql);

?>



<!-- esto incluye la conexión, consulta todos los productos
     y guarda el resultado en $resultado-->


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
            font-family: Arial, Helvetica, sans-serif;
            background:#f2f2f2;
        }

        header{
            background:orange;
            color:white;
            padding:20px;
            text-align:center;
        }

        .contenedor{
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
            gap:20px;
            padding:30px;
            justify-content: center

        }

        .card{
            background:white;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0px 0px 10px rgba(0,0,0,0.2);
            transition:0.3s;
        }
        
        .card:hover{
            transform:scale(1.03);
        }

        .card img{
            width:100%;
            height:200px;
            object-fit:cover;
        }

        .info{
            padding:15px;
            display:flex;
            flex-direction:column;
        }

        .info h3{
            margin-bottom:10px;
        }

        .descripcion{
            color:gray;
            font-size:14px;
            margin-bottom:10px;
        }

        .precio{
            text-decoration:line-through;
            color:red;
        }

        .descuento{
            color:green;
            font-size:22px;
            font-weight:bold;
            margin:10px 0;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            background:orange;
            color:white;
            font-size:16px;
            cursor:pointer;
        }

        button:hover{
            background:orangered;
        }

        .enlaces{
            text-align:center;
            margin:30px;
        }

        .enlaces a{
            text-decoration:none;
            background:orange;
            color:white;
            padding:12px 20px;
            border-radius:5px;
            margin:10px;
            display:inline-block;
        }

        .enlaces a:hover{
            background:orangered;
        }

        .carrito{
            margin-top:15px;
            font-size:22px;
            font-weight:bold;
        }

        .stock{
            margin-top:8px;
            font-size:15px;
            font-weight:bold;
        }

        .stock.disponible{
            color:#2e7d32;
        }

        .stock.pocas{
            color:#ef6c00;
        }

        .stock.ultimas{
            color:#c62828;
        }

        .disponible{
            color:#28a745;
        }

        .pocas{
            color:#ff9800;
        }

        .agotado{
            color:#dc3545;
        }

        button:disabled{
            background:#9e9e9e;
            cursor:not-allowed;
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
            margin-top:20px;
        }

        .redes a{
            color:white;
            text-decoration:none;
            font-weight:bold;
            transition:.3s;
        }

        .redes a:hover{
            color:#ff914d;
        }

        /* MODO OSCURO */
        .dark{
            background:#121212;
            color:white;
        }

        .dark header{
            background:orange;
        }

        .dark .card{
            background:#2b2b2b;
            color:white;
        }

        .dark .descripcion{
            color:#d0d0d0;
        }

        .dark .precio{
            color:#ff6b6b;
        }

        .dark .descuento{
            color:#4caf50;
        }

        .dark button{
            background:#ff9800;
        }

        .dark button:hover{
            background:#ff6d00;
        }

        .dark .enlaces a{
            background:#ff9800;
            color:white;
        }

        .dark .enlaces a:hover{
            background:#ff6d00;
        }

        .dark .carrito a{
            color:white;
            text-decoration:none;
        }

        .dark .stock{
            color:white;
        }

        .dark .disponible{
            color:#4caf50;
        }

        .dark .pocas{
            color:#ffc107;
        }

        .dark .agotado{
            color:#ff5252;
        }

        /*==========================
                Laptop
        ==========================*/

        @media screen and (max-width:1200px){

        .contenedor{
            grid-template-columns:repeat(2,1fr);
        }

        }

        /*==========================
                Tablet
        ==========================*/

        @media screen and (max-width:768px){

        header{
            padding:15px;
        }

        .contenedor{
            grid-template-columns:1fr;
            padding:20px;
        }

        .enlaces{
            display:flex;
            flex-direction:column;
            gap:15px;
        }

        .footer-info{
            flex-direction:column;
            text-align:center;
        }

        }

        /*==========================
                Celular
        ==========================*/

        @media screen and (max-width:480px){

        header h1{
            font-size:24px;
        }

        .card img{
            height:180px;
        }

        .enlaces a{
            width:100%;
        }

        }
    </style>

</head>
<body class="<?= ($modo == "oscuro") ? "dark" : "" ?>">
    <header>

    <h1>🍔 Menú Flash Bite</h1>

    <div class="carrito">

        <a href="form_pedido.php" style="color:white; text-decoration:none;">

            🛒 <?php echo $contador; ?>

        </a>

    </div>

</header>


    <div class="contenedor">
        
    <?php  //mientras existan productos en la base de datos, crea una tarjeta

    while($producto = mysqli_fetch_assoc($resultado)){

    ?>

    <div class="card">

        <img src="<?php echo $producto['imagen']; ?>">

        <div class="info">

        <h3><?php echo $producto['nombre']; ?></h3>

        <p class="descripcion">
            <?php echo $producto['descripcion']; ?>
        </p>

        <p class="precio">
            S/ <?php echo number_format($producto['precio_original'],2); ?>
        </p>

        <p class="descuento">
            S/ <?php echo number_format($producto['precio_descuento'],2); ?>
        </p>

        <p class="stock disponible">
            Disponible
        </p>

        <?php

/*=========================================
    MOSTRAR EL ESTADO DEL STOCK
==========================================*/

if($producto["stock"] > 10){

?>

    <p class="stock disponible">
        ✅ Disponible
        (<?php echo $producto["stock"]; ?> unidades)
    </p>

<?php
}elseif($producto["stock"] > 5){
?>

    <p class="stock pocas">
        ⚠️ Quedan pocas unidades
        (<?php echo $producto["stock"]; ?>)
    </p>

<?php
}else{
?>

    <p class="stock ultimas">
        🔥 Últimas unidades
        (<?php echo $producto["stock"]; ?>)
    </p>

<?php
}
?>

<!-- //si en la bd hay 20 se vera, disponible 20 unidades, 
//si baja a 8 se vera quedan pocas unidades,
//si baja a 3 se vera ultimas unidades -->


            <!-- Al hacer clic en el botón se envía el ID del producto
al archivo agregar_carrito.php
-->

<form
    action="php/agregar_carrito.php"
    method="POST">

    <input
        type="hidden"
        name="tipo"
        value="producto">

    <input
        type="hidden"
        name="id"
        value="<?php echo $producto["id_producto"]; ?>">

    <button type="submit">

        Añadir al Pedido

    </button>

</form>



        </div>

    </div>

    <?php

    }

    ?>
        
        
    </div>

    <div class="enlaces">   

        <a href="form_pedido.php">
             Ver Pedido
        </a>

        <a href="ofertas.php">
            Ver Ofertas
        </a>

        <a href="index.php">
            Ir a inicio
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
                    <h3>📍 Ubicación</h3>
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
                    <h3>📞 Contacto</h3>
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
                © 2026 Flash Bite - Todos los derechos reservados
            </p>

        </div>
        <script src="js/menu.js"></script>
        
    </footer>
</body>
</html> 