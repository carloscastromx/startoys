<?php 
    session_start();
    if(!isset($_SESSION['loggeado'])){
        header("Location: https://startoys.shop/login.php");
    }

    if($_SESSION['totalpedido'] == 0 || !isset($_SESSION['totalpedido'])){
        header("Location: https://startoys.shop/carrito/");
    }

    $ids = implode(",", $_SESSION['carrito']);

    $cantidad = count($_SESSION['carrito']);

    $server = "localhost";
    $user= "u976611399_2GwXe";
    $pass_bd = "fJSw8NDd";
    $bd = "u976611399_startoys";

    $conexion = new mysqli($server,$user,$pass_bd,$bd);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    } else {
        $consulta = "SELECT * FROM Productos WHERE id_producto IN ($ids)";
        $resultados = mysqli_query($conexion,$consulta);
        //Convertir a arreglos para iteración
        $productos = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

        mysqli_free_result($resultados);

        if(isset($_SESSION['descuento-aplicado']) && $_SESSION['descuentoyaaplicado'] != 1){
            $aplicado = true;
            $descuento = $_SESSION['descuentocant'] / 100;
            $total_pedido = $_SESSION['totalpedido'];
            $descuento_precio = $descuento * $total_pedido;
            $total_pedido = $total_pedido - $descuento_precio;

            $_SESSION['descuentoprecio'] = $descuento_precio;
            $_SESSION['totalpedido'] = $total_pedido;
            $_SESSION['descuentoyaaplicado'] = 1;
        } else {
            $total_pedido = $_SESSION['totalpedido'];
        }

        $colecciones = array("", "Muñecas", "Casas", "Accesorios");

        mysqli_close($conexion);
    }
?>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Star Toys</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Raleway:wght@500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <img src="../Star Toys.svg" alt="Logo" class="logo">
        <nav>
            <a class="inicio" href="https://startoys.shop/">Inicio</a>
            <a class="colecciones" href="https://startoys.shop/colecciones/">Colecciones</a>
            <a class="productos" href="https://startoys.shop/productos/">Productos</a>
        </nav>
        <div class="icons">
            <a href="../login.php">
                <img src="../Usuario.svg" alt="Usuario" class="usuario">
            </a>
            <a href="https://startoys.shop/carrito/">
                <img src="https://startoys.shop/Carrito.svg" alt="Carrito" class="carrito"> 
            </a>
        </div>
    </header>        
    <section class="main-colecciones">
        <h1>Finalizar Pedido</h1>
        <section class="checkout-section">
            <p class="Resumen">Resumen de Pedido</p>
            <div class="resumen-pedido">
                <?php foreach($productos as $producto){ ?>
                    <div class="fila-pedido">
                        <div class="datos-producto2">
                            <p class="nombre"><?php echo $producto['nombre']; ?></p>
                            <p class="coleccion"><?php echo $colecciones[$producto['coleccion']]; ?></p>
                        </div>
                        <div class="precio-producto">
                            <p class="precio-tabla">$
                                <?php
                                    $precio = (float)$producto['precio'];
                                    echo number_format($precio,0,".",","); 
                                ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
                <div class="cupon-row">
                    <p class="descuento">Descuento <span id="descuento-cant-txt">$
                        <?php
                            if (!isset($_SESSION['descuentoprecio'])) {
                                echo "-";
                            } else {
                                $desc_p = $_SESSION['descuentoprecio'];
                                echo number_format($desc_p,0,".",",");
                            }
                        ?>
                    </span></p>
                </div>
                <div class="total-row2">
                    <p>Total a pagar <span>$<?php echo number_format($total_pedido,0,".",","); ?></span></p> 
                </div> 
            </div>
            <?php if (!isset($_SESSION['descuento-aplicado'])) { ?>
                <div class="cupon-row-input">
                    <form action="validacion-cupon.php" method="POST">
                        <input type="text" placeholder="Código de cupón" name="cupon-id-val" id="input-cod-cupon" required>
                        <input type="submit" value="Aplicar Cupón" id="btn-cupon">
                    </form>
                </div>
            <?php } ?>
            <p id="error-msg"></p>
            <p class="Datos">Datos de Pago</p>
            <form class="Pago">
                <div class="fila-superior">
                    <div class="div-col-form">
                        <label>Número de Tarjeta</label>
                        <input type="text" name="num-tarjeta" id="num-tarjeta" maxlength="16" placeholder="0401 0912 1313 2361">
                    </div>
                    <div class="div-col-form">
                        <label>Vencimiento</label>
                        <div>
                            <input type="text" name="vencimiento-m" id="vencimiento-m" maxlength="2" placeholder="MM">
                            <input type="text" name="vencimiento-a" id="vencimiento-a" maxlength="2" placeholder="AA">
                        </div>
                    </div>
                    <div class="div-col-form">
                        <label>CVV</label>
                        <input type="text" name="cvv-tarjeta" id="cvv-tarjeta" maxlength="3" placeholder="XXX">
                    </div>
                </div>
                <div class="fila-inferior">
                    <label>Titular de la tarjeta</label>
                    <input type="text" name="nom-titular" id="nom-titular" placeholder="Nombre completo">
                </div>
                <div class="fila-btn-terminar">
                    <a href="https://startoys.shop/checkout/procesamiento.php?finalizado=1">Finalizar</a>
                </div>
            </form>
        </section>
    </section>
    <footer class="final">
        <div>
            <p>Star Toys © 2022. Todos los derechos reservados </p>
        </div>
        <div class="icons">
            <a href="#">
                <img src="../icon-facebook.svg" alt="Facebook" class="usuario">
            </a>
            <a href="#">
                <img src="../icon-instagram.svg" alt="Instagram" class="carrito"> 
            </a>
        </div>
        
    </footer>
</body>
</html>