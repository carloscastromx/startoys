<?php 
    session_start();
    if(!isset($_SESSION['loggeado'])){
        header("Location: https://startoys.shop/login.php");
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

        $total_carrito = 0;
        foreach($productos as $p){
            $total_carrito += (float)$p['precio'];
        }

        //Agregar envío de $99
        $total_carrito += 99;

        $_SESSION['totalpedido'] = $total_carrito;

        if(count($productos) >= 1){
            $prods = true;
        } else {
            $prods = false;
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
    <title>Carrito | Star Toys</title>
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
        <h1>Carrito de Compras</h1>
        <section>
        <p class="carrito-txt-h">
        <?php if($prods == false){
            echo "No has agregado ningun producto";
        } else {
            echo "Mostrando ".$cantidad." productos";}
        ?>
        </p>
        <div class="carrito-box">
            <?php if($prods == true){
                foreach($productos as $producto){ ?>
                    <div class="producto-carrito">
                        <div style="width: 15%;">
                            <img src="https://startoys.shop/imgs/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                        </div>
                        
                        <div class="datos-producto-carrito">
                            <h3><?php echo $producto['nombre']; ?></h3>
                            <p class="coleccion-carrito"><?php echo $colecciones[$producto['coleccion']]; ?></p>
                            <p class="precio-carrito">$<?php
                                $precio = (float)$producto['precio'];
                                echo number_format($precio,0,".",","); 
                            ?></p>
                        </div>
                    </div>
                <?php }
            } ?>
            <div class="total-row">
            <?php if($prods == true){ ?>
                <p>Total <span>$<?php echo number_format($total_carrito,0,".",","); ?></span></p>
            <?php } ?>
            </div>
        </div>
        <div class="btn-carrito-row">
            <?php if($prods == true){ ?>
                <a href="https://startoys.shop/checkout/" class="btn-checkout">Proceder al pago</a>
            <?php } ?>
        </div>        
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