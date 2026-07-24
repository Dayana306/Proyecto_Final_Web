<?php

session_start();

/*=========================================
        CONTADOR DEL CARRITO
  Cuenta cuántos productos tiene
  actualmente el carrito.
=========================================*/
$contador = 0;

if(isset($_SESSION["carrito"])){

    foreach($_SESSION["carrito"] as $item){

        $contador += $item["cantidad"];

    }

}

/*=========================================
        CONEXIÓN A MYSQL

  Conecta con la base de datos flashbite
=========================================*/
include("conexion/conexion.php");

// Modo por defecto
$modo = "claro";

// Si existe en la sesión
if(isset($_SESSION["modo"])){
    $modo = $_SESSION["modo"];
}

/*=========================================
        PRODUCTOS EN OFERTA

  Aquí seleccionamos qué productos
  aparecerán como ofertas.

  Solo cambia los números por los
  id_producto que quieras mostrar.
=========================================*/

$sqlOfertas = "
    SELECT *
    FROM productos
    WHERE es_oferta = 1
    ORDER BY nombre ASC
";

$resultadoOfertas = mysqli_query($conexion,$sqlOfertas);

/*=========================================
        COMBOS ESPECIALES

  Estos tendrán una tarjeta diferente
  más grande y horizontal.
=========================================*/

$sqlCombos = "
    SELECT *
    FROM combos
    WHERE estado='Disponible'
    ORDER BY nombre ASC
";

$resultadoCombos = mysqli_query($conexion,$sqlCombos);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title> Ofertas - Flash Bite </title>
    <link rel="icon" href="logo.jpeg">

    <style>

        /*=========================================
                    CONFIGURACIÓN GENERAL
        =========================================*/
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, Helvetica, sans-serif;
            background:#f2f2f2;
        }

        /*=========================================
                    HEADER
        =========================================*/
     
        header{
            background:orange;
            color:white;
            padding:20px 30px;
            display:flex;
            justify-content:center;
            align-items:center;
            position:relative;
        }

        .carrito{
            position:absolute;
            right:30px;
            top:50%;
            transform:translateY(-50%);
            font-size:22px;
            font-weight:bold;
        }

        .carrito a{
            color:white;
            text-decoration:none;
        }

        /*=========================================
                CONTENEDOR OFERTAS
        =========================================*/

        .contenedor{
            display:grid;
            grid-template-columns:
            repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
            padding:30px;
        }

        /*=========================================
                    TARJETA OFERTA
        =========================================*/

        .card{
            background:white;
            border-radius:12px;
            overflow:hidden;
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            transition:.3s;
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
            padding:20px;
        }

        .info h3{
            margin-bottom:10px;
        }

        /*=========================================
                    TARJETA COMBO
        =========================================*/

        .combo{
            display:flex;
            width:90%;
            max-width:1000px;
            margin:30px auto;
            background:white;
            border-radius:12px;
            overflow:hidden;
            box-shadow: 0 0 10px rgba(0,0,0,.2);
        }

        .combo{
            display:flex;
            width:90%;
            max-width:1000px;
            margin:30px auto;
            background:white;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 0 10px rgba(0,0,0,.2);
            transition:.3s;
        }

        .combo:hover{
            transform:translateY(-8px) scale(1.02);
            box-shadow: 0 0 25px orange, 0 0 45px #ff9800, 0 18px 35px rgba(0,0,0,.4);
        }

        .combo img{
            width:350px;
            height:230px;
            object-fit:cover;
        }

        .combo .info{
            flex:1;
            padding:25px;
        }

        .descripcion{
            color:gray;
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
            transition:.3s;
        }

        .btnAgregar,
        .btnConfirmar{
            width:100%;
            padding:10px;
            font-size:14px;
            border:none;
            border-radius:8px;
            background:orange;
            color:white;
            cursor:pointer;
        }

        .contadorProducto{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:10px;
            margin-top:12px;
        }
        
        .contadorProducto button{
            width:34px;
            height:34px;
            border:none;
            border-radius:50%;
            background:orange;
            color:white;
            font-size:18px;
            cursor:pointer;
        }

        .btnMenos,
        .btnMas{
            width:40px;
            height:40px;
            border-radius:50%;
            font-size:22px;
            font-weight:bold;
            padding:0;
        }

        .cantidad{
            width:35px;
            text-align:center;
            font-size:20px;
            font-weight:bold;
        }

        .btnConfirmar{
            width:100%;
            margin-top:12px;
        }

        .btnConfirmar{
            width:100% !important;
            height:42px !important;
            border-radius:8px !important;
            margin-top:15px;
            font-size:14px !important;
            font-weight:bold;
        }

        .stock.disponible{
            color:green;
            font-weight:bold;
        }

        .stock.pocas{
            color:#d68910;
            font-weight:bold;
        }

        .stock.ultimas{
            color:#e67e22;
            font-weight:bold;
        }



        

        /* PRODUCTO / COMBO AGOTADO */

.card.agotado{
    opacity:0.65;
}
.imagenAgotada{
    filter:grayscale(100%);
    opacity:.6;
}
.card.agotado h3{
    color:#777;
}

.card.agotado .descripcion{
    color:#999;
}

.card.agotado .precio{
    color:#999;
}

.card.agotado .descuento{
    color:#777;
}

.card.agotado .stock.agotado{
    color:#777;
}

.card.agotado button{
    background:#9e9e9e;
    color:white;
    cursor:not-allowed;
}
.combo.agotado{
    opacity:.65;
}

.combo.agotado img{
    filter:grayscale(100%);
    opacity:.6;
}

.combo.agotado h3{
    color:#777;
}

.combo.agotado .descripcion{
    color:#999;
}

.combo.agotado .precio{
    color:#999;
}

.combo.agotado .descuento{
    color:#777;
}

.combo.agotado button{
    background:#9e9e9e;
    cursor:not-allowed;
}

        button:hover{
        background:orangered;
        transform:translateY(-3px);
        box-shadow: 0 0 15px rgba(255,140,0,.6);
        }

        button:hover{
            background:orangered;
        }

        /*=========================================
                    MODO OSCURO
        =========================================*/

        .dark{
            background:#121212;
            color:white;
        }

        .dark header{
            background:#e68900;
        }

        .dark .card{
            background:#2b2b2b;
            color:white;
        }

        .dark .combo{
            background:#2b2b2b;
            color:white;
        }

        .dark .descripcion{
            color:#ddd;
        }

        .dark .precio{
            color:#ff6b6b;
        }

        .dark .descuento{
            color:#4caf50;
        }

        /*=========================================
                    ENLACES
        =========================================*/

        .enlaces{
            text-align:center;
            margin:40px;
        }

        .enlaces a{
            background:orange;
            color:white;
            padding:12px 20px;
            border-radius:8px;
            text-decoration:none;
            margin:10px;
            display:inline-block;
        }

        .enlaces a:hover{
            background:orangered;
        }

        /*=========================================
                    FOOTER
        =========================================*/

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

        /*=========================================
                    RESPONSIVE
        =========================================*/

        @media(max-width:768px){

            .contenedor{
                grid-template-columns:1fr;
            }

            .combo{
                display:block;
                width:90%;
            }

            .combo img{
                width:100%;
                height:200px;
            }

            .footer-info{
                flex-direction:column;
            }

        }

    </style>

</head>

<body class="<?= ($modo == "oscuro") ? "dark" : "" ?>">

<header>


<h1>
🔥 Ofertas Flash Bite
</h1>



<div class="carrito">


<a href="form_pedido.php">

🛒

<?php echo $contador; ?>


</a>


</div>


</header>


<!--=========================================
              BOTONES NAVEGACIÓN
==========================================-->


<div class="enlaces">


<a href="menu.php">

Ver Menú

</a>



<a href="form_pedido.php">

 Ver Pedido

</a>



<a href="index.php">

Ir a Inicio

</a>



</div>

<!--=========================================
            SECCIÓN OFERTAS
==========================================-->

<h2 style="text-align:center; margin-top:30px;">
🔥 Ofertas Especiales
</h2>


<div class="contenedor">


<?php


/*=========================================
      RECORRER PRODUCTOS EN OFERTA

      Mientras existan productos,
      crea una tarjeta por cada uno.
=========================================*/


while($producto = mysqli_fetch_assoc($resultadoOfertas)){
$stockVisual = $producto["stock"];

if(isset($_SESSION["carrito"])){

    foreach($_SESSION["carrito"] as $item){

        if(
            $item["tipo"] == "producto" &&
            $item["id"] == $producto["id_producto"]
        ){

            $stockVisual -= $item["cantidad"];

        }

    }

}

if($stockVisual < 0){

    $stockVisual = 0;

}

?>


<div class="card <?php echo ($stockVisual==0) ? "agotado" : ""; ?>">

    <img
        src="<?php echo $producto['imagen']; ?>"
        class="<?php echo ($stockVisual==0) ? 'imagenAgotada' : ''; ?>">

    <div class="info">


<h3>

<?php echo $producto['nombre']; ?>

</h3>



<p class="descripcion">

<?php echo $producto['descripcion']; ?>

</p>



<p class="precio">

Antes:

S/

<?php echo number_format($producto['precio_original'],2); ?>

</p>



<p class="descuento">

Ahora:

S/

<?php echo number_format($producto['precio_descuento'],2); ?>

</p>



<p>

🔥 Oferta disponible

</p>



<p
class="stock
<?php

if($stockVisual <= 0){

    echo "agotado";

}
elseif($stockVisual<= 3){

    echo "ultimas";

}
elseif($stockVisual<= 5){

    echo "pocas";

}
else{

    echo "disponible";

}

?>"

data-stock="<?php echo $stockVisual; ?>">

<?php

if($stockVisual <= 0){

    echo "❌ Producto agotado";

}
elseif($stockVisual <= 3){

    echo "🔥 Últimas unidades (" .
    $stockVisual . ")";

}
elseif($stockVisual <= 5){

    echo "⚠️ Quedan pocas unidades (" .
    $stockVisual . ")";

}
else{

    echo "✅ Disponible (" .
    $stockVisual .
    " unidades)";

}

?>

</p>




<!--=========================================
        FORMULARIO PARA CARRITO

        Envía el ID del producto
        al archivo agregar_carrito.php
=========================================-->

<?php if($producto["stock"] > 0){ ?>

<div class="acciones-producto">

<form
action="php/agregar_carrito.php"
method="POST"
class="formAgregar">

    <input type="hidden" name="tipo" value="producto">

    <input
        type="hidden"
        name="id"
        value="<?php echo $producto['id_producto']; ?>">

    <input
        type="hidden"
        name="cantidad"
        value="1"
        class="cantidadInput">

    <button
        type="button"
        class="btnAgregar">

        Añadir al Pedido

    </button>

    <div
        class="contadorProducto"
        style="display:none;">

        <button
            type="button"
            class="btnMenos">

            −

        </button>

        <span class="cantidad">

            1

        </span>

        <button
            type="button"
            class="btnMas">

            +

        </button>

        <button
            type="submit"
            class="btnConfirmar">

            Agregar al pedido

        </button>

    </div>

</form>

</div>

<?php }else{ ?>

<div class="acciones-producto">

    <button
        disabled
        style="
            background:#9e9e9e;
            color:white;
            cursor:not-allowed;
        ">

        Agotado

    </button>

</div>

<?php } ?>

</div>

</div>



<?php

}


?>


</div>





<!--=========================================
            SECCIÓN COMBOS
==========================================-->



<h2 style="text-align:center; margin-top:50px;">

🍟 Combos Especiales

</h2>




<?php



/*=========================================
        RECORRER COMBOS

        Estos tendrán otra tarjeta
        con diseño horizontal.
=========================================*/


while($combo = mysqli_fetch_assoc($resultadoCombos)){

    $stockVisual = $combo["stock"];

    if(isset($_SESSION["carrito"])){

        foreach($_SESSION["carrito"] as $item){

            if(
                $item["tipo"] == "combo" &&
                $item["id"] == $combo["id_combo"]
            ){

                $stockVisual -= $item["cantidad"];

            }

        }

    }

    if($stockVisual < 0){
        $stockVisual = 0;
    }

?>



<div class="combo <?php echo ($stockVisual==0) ? "agotado" : ""; ?>">



<img
src="imagenes/<?php echo $combo['imagen']; ?>"
alt="<?php echo $combo['nombre']; ?>"
class="<?php echo ($stockVisual==0) ? 'imagenAgotada' : ''; ?>">



<div class="info">



<h3>

✨🍜✨ <?php echo $combo['nombre']; ?>

</h3>



<p class="descripcion">

<?php echo $combo['descripcion']; ?>

</p>



<p class="precio">

Antes:

S/

<?php echo number_format($combo['precio_original'],2); ?>

</p>



<p class="descuento">

Combo:

S/

<?php echo number_format($combo['precio_descuento'],2); ?>

</p>



<p>

🍔 Incluye combinación especial

</p>

<p style="
color:#ff5722;
font-weight:bold;
margin-top:10px;
">
📢 Solo por hoy
</p>

<p
class="stock <?php

if($stockVisual <= 0){

    echo "agotado";

}elseif($stockVisual <= 3){

    echo "ultimas";

}elseif($stockVisual <= 5){

    echo "pocas";

}else{

    echo "disponible";

}

?>"
data-stock="<?php echo $stockVisual; ?>">

<?php

if($stockVisual <= 0){

    echo "❌ Combo agotado";

}elseif($stockVisual <= 3){

    echo "🔥 Últimas unidades ($stockVisual)";

}elseif($stockVisual <= 5){

    echo "⚠️ Quedan pocas unidades ($stockVisual)";

}else{

    echo "✅ Disponible ($stockVisual unidades)";

}

?>

</p>

<div class="acciones-producto">

<form
action="php/agregar_carrito.php"
method="POST"
class="formAgregar">

    <input
    type="hidden"
    name="tipo"
    value="combo">

    <input
    type="hidden"
    name="id"
    value="<?php echo $combo["id_combo"]; ?>">

    <input
    type="hidden"
    name="cantidad"
    value="1"
    class="cantidadInput">


    <?php if($stockVisual > 0){ ?>

    <button
        type="submit"
        class="btnConfirmar">

        Añadir Combo

    </button>

    <?php }else{ ?>

    <button
        disabled
        style="background:#9e9e9e;cursor:not-allowed;">

        Agotado

    </button>

    <?php } ?>

      </form>

    </div>

  </div>

</div>


<?php

}


?>






<!--=========================================
              FOOTER
==========================================-->
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

</footer>

<script src="js/menu.js"></script>

</body>
</html>
