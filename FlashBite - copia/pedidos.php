<?php

/*=========================================================
    HISTORIAL DE PEDIDOS
==========================================================
    Este archivo muestra todos los pedidos registrados
    junto con sus productos y combos.
=========================================================*/

/*=========================================================
    CONEXIÓN A LA BASE DE DATOS
=========================================================*/

include("conexion/conexion.php");

/*=========================================================
    OBTENER TODOS LOS PEDIDOS
=========================================================*/

$sqlPedidos = "

SELECT *

FROM pedidos

ORDER BY id_pedido DESC

";

$resultadoPedidos = mysqli_query($conexion,$sqlPedidos);

if(!$resultadoPedidos){

    die(mysqli_error($conexion));

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Flash Bite</title>

<link rel="icon" href="logo.jpeg" type="image/jpeg">

<style>
/*======================================================
    CONFIGURACIÓN GENERAL
======================================================*/

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:Arial, Helvetica, sans-serif;
    background:#f2f2f2;
    color:#333;

}


/*======================================================
    HEADER
======================================================*/

header{

    background:orange;
    color:white;
    padding:25px;
    text-align:center;

}


header h1{

    font-size:32px;

}



/*======================================================
    CONTENEDOR PRINCIPAL
======================================================*/

.contenedor{

    width:90%;
    max-width:1200px;
    margin:40px auto;

    background:white;

    padding:30px;

    border-radius:12px;

    box-shadow:0 0 15px rgba(0,0,0,.2);

}



/*======================================================
    TARJETA DEL PEDIDO
======================================================*/

.pedido{

    background:white;

    padding:25px;

    margin-bottom:25px;

    border-left:7px solid orange;

    border-radius:12px;

    box-shadow:0 4px 10px rgba(0,0,0,.15);

}


.pedido h2{

    color:orangered;

    margin-bottom:15px;

}


.pedido p{

    margin:10px 0;

}



/*======================================================
    PRODUCTOS DEL PEDIDO
======================================================*/

.producto{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:15px 0;

}


.producto strong{

    color:#333;

}



.producto hr{

    margin:15px 0;

}


/*======================================================
    ESTADOS DEL PEDIDO
======================================================*/

.enviado{

    color:green;

    font-weight:bold;

}


.proceso{

    color:orange;

    font-weight:bold;

}


.preparando{

    color:red;

    font-weight:bold;

}



/*======================================================
    BOTONES
======================================================*/


.enlaces{

    text-align:center;

    margin-top:30px;

}


.enlaces a{

    display:inline-block;

    background:orange;

    color:white;

    padding:12px 25px;

    margin:10px;

    border-radius:6px;

    text-decoration:none;

    transition:.3s;

}



.enlaces a:hover{

    background:orangered;

    transform:scale(1.05);

}



/*======================================================
    FOOTER
======================================================*/

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


/*======================================================
    MODO OSCURO
======================================================*/


.dark{

    background:#121212;

    color:white;

}



.dark .contenedor{

    background:#1f1f1f;

    color:white;

}



.dark .pedido{

    background:#2b2b2b;

    color:white;

    border-left:7px solid orange;

}



.dark .pedido h2{

    color:#ff9800;

}



.dark .producto strong{

    color:white;

}



.dark hr{

    border-color:#555;

}



.dark .enlaces a{

    background:#ff9800;

}


.dark .enlaces a:hover{

    background:#ff6d00;

}


.dark footer{

    background:#000;

}



/*======================================================
    RESPONSIVE
======================================================*/


@media(max-width:768px){


.contenedor{

    width:95%;

    padding:20px;

}



.producto{

    flex-direction:column;

    align-items:flex-start;

    gap:15px;

}



.enlaces{

    display:flex;

    flex-direction:column;

}



.enlaces a{

    width:100%;

}



.footer-info{

    flex-direction:column;

    text-align:center;

}


}



@media(max-width:480px){


header h1{

    font-size:24px;

}


.pedido{

    padding:15px;

}



}

</style>
<body>

<header>

    <h1>🍔 Historial de Pedidos</h1>

</header>

<div class="contenedor">

<?php

/*=========================================================
    RECORRER TODOS LOS PEDIDOS
=========================================================*/

if(mysqli_num_rows($resultadoPedidos)>0){

    while($pedido = mysqli_fetch_assoc($resultadoPedidos)){

?>

<!--=========================================================
    TARJETA DEL PEDIDO
==========================================================-->

<div class="pedido">

    <h2>

        Pedido #<?php echo $pedido["id_pedido"]; ?>

    </h2>

    <p>

        <strong>Fecha:</strong>

        <?php echo $pedido["fecha"]; ?>

    </p>

    <p>

        <strong>Dirección:</strong>

        <?php echo $pedido["direccion_entrega"]; ?>

    </p>

    <p>

        <strong>Estado:</strong>

        <?php echo $pedido["estado"]; ?>

    </p>

    <hr>

<?php

/*=========================================================
    BUSCAR LOS PRODUCTOS DEL PEDIDO
=========================================================*/

$idPedido = $pedido["id_pedido"];

$sqlDetalle = "

SELECT *

FROM detalle_pedido

WHERE id_pedido='$idPedido'

";

$resultadoDetalle = mysqli_query($conexion,$sqlDetalle);

/*=========================================================
    RECORRER TODOS LOS PRODUCTOS DEL PEDIDO
=========================================================*/

while($detalle = mysqli_fetch_assoc($resultadoDetalle)){

    /*=====================================================
        Obtener datos del detalle
    =====================================================*/

    $tipo = $detalle["tipo"];

    $idProducto = $detalle["id_producto"];

    $cantidad = $detalle["cantidad"];

    $precio = $detalle["precio"];

    /*=====================================================
        Buscar el nombre según el tipo
    =====================================================*/

    if($tipo=="producto"){

        $sqlProducto="

        SELECT *

        FROM productos

        WHERE id_producto='$idProducto'

        ";

    }else{

        $sqlProducto="

        SELECT *

        FROM combos

        WHERE id_combo='$idProducto'

        ";

    }

    $resultadoProducto = mysqli_query($conexion,$sqlProducto);

    if($producto = mysqli_fetch_assoc($resultadoProducto)){

        $subtotal = $cantidad * $precio;

?>

<!--=====================================================
    PRODUCTO DEL PEDIDO
======================================================-->

<div class="producto">

    <div>

        <strong>

            <?php echo $producto["nombre"]; ?>

        </strong>

        <?php

        if($tipo=="producto"){

            echo " 🍔";

        }else{

            echo " 🎁";

        }

        ?>

        <br>

        Cantidad:

        <strong>

            <?php echo $cantidad; ?>

        </strong>

        <br>

        Precio:

        <strong>

            S/<?php echo number_format($precio,2); ?>

        </strong>

    </div>

    <div style="text-align:right;">

        <strong>

            Subtotal

        </strong>

        <br>

        S/<?php echo number_format($subtotal,2); ?>

    </div>

</div>

<hr>
<?php

    }   // Cierra if($producto)

}       // Cierra while($detalle)


/*=========================================================
    CALCULAR EL TOTAL DEL PEDIDO
=========================================================*/

$sqlTotal = "

SELECT

SUM(cantidad * precio) AS total

FROM detalle_pedido

WHERE id_pedido='$idPedido'

";

$resultadoTotal = mysqli_query($conexion,$sqlTotal);

$filaTotal = mysqli_fetch_assoc($resultadoTotal);

$totalPedido = $filaTotal["total"];

?>

<!--=========================================================
    TOTAL DEL PEDIDO
==========================================================-->

<p
style="
text-align:right;
font-size:20px;
margin-top:20px;
color:#2e7d32;
">

<strong>

Total del Pedido:

S/<?php echo number_format($totalPedido,2); ?>

</strong>

</p>

</div>

<?php

    }

}else{

?>

<h2
style="
text-align:center;
margin-top:40px;
">

No existen pedidos registrados.

</h2>

<?php

}

?>

<!--=========================================================
    BOTONES
==========================================================-->

<div class="enlaces">

<a href="form_pedido.php">

Ir a Pedido

</a>

<a href="menu.php">

Ir a Menú

</a>

<a href="index.php">

Ir a Inicio

</a>

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
<script src="js/modo.js"></script>
        
    </footer>

</body>
</html>