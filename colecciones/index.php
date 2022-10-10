<?php 

$server = "localhost";
$user= "u976611399_2GwXe";
$pass_bd = "fJSw8NDd";
$bd = "u976611399_startoys";

$conexion = new mysqli($server,$user,$pass_bd,$bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    //Consulta para obtener los productos de las colecciones
    //Productos de "Casas"
    $consulta = "SELECT * FROM Productos WHERE coleccion = 2 ORDER BY id_producto DESC LIMIT 4";
    $resultados = mysqli_query($conexion,$consulta);
    //Convertir a arreglos para iteración
    $r_casas = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

    mysqli_free_result($resultados);

    //Productos de "Muñecas"
    $consulta = "SELECT * FROM Productos WHERE coleccion = 1 ORDER BY id_producto DESC LIMIT 4";
    $resultados = mysqli_query($conexion,$consulta);
    $r_munecas = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

    mysqli_free_result($resultados);

    //Productos de "Accesorios"
    $consulta = "SELECT * FROM Productos WHERE coleccion = 3 ORDER BY id_producto DESC LIMIT 4";
    $resultados = mysqli_query($conexion,$consulta);
    $r_acc = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

    mysqli_free_result($resultados);

    mysqli_close($conexion);
    
}

?>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Toys</title>
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
        <h1>Colecciones</h1>
        <h2>Casas</h2>
        <div class="productos-nuevos">
            <?php foreach($r_casas as $producto){ ?>
                    <div class="producto-nuevo-box">
                    <div class="imagen">
                        <img src="https://startoys.shop/imgs/<?php echo $producto['imagen']; ?>">
                    </div>
                    <p class="textocuadro"><?php echo $producto['nombre']; ?></p>
                    <p class="precio">$<?php
                        $precio = (float)$producto['precio'];
                        echo number_format($precio,0,".",","); 
                    ?></p>
                    <a href="https://startoys.shop/producto.php?id=<?php echo $producto['id_producto']; ?>" class="ver-mas">Ver más</a>
                </div>
            <?php } ?>
        </div>
        <a href="https://startoys.shop/colecciones/casas/" class="ver-mas">Ver Colección</a>
        <h2>Muñecas</h2>
        <div class="productos-nuevos">
            <?php foreach($r_munecas as $producto){ ?>
                    <div class="producto-nuevo-box">
                    <div class="imagen">
                        <img src="https://startoys.shop/imgs/<?php echo $producto['imagen']; ?>">
                    </div>
                    <p class="textocuadro"><?php echo $producto['nombre']; ?></p>
                    <p class="precio">$<?php
                        $precio = (float)$producto['precio'];
                        echo number_format($precio,0,".",","); 
                    ?></p>
                    <a href="https://startoys.shop/producto.php?id=<?php echo $producto['id_producto']; ?>" class="ver-mas">Ver más</a>
                </div>
            <?php } ?>
        </div>
        <a href="https://startoys.shop/colecciones/munecas/" class="ver-mas">Ver Colección</a>
        <h2>Accesorios</h2>
        <div class="productos-nuevos">
            <?php foreach($r_acc as $producto){ ?>
                    <div class="producto-nuevo-box">
                    <div class="imagen">
                        <img src="https://startoys.shop/imgs/<?php echo $producto['imagen']; ?>">
                    </div>
                    <p class="textocuadro"><?php echo $producto['nombre']; ?></p>
                    <p class="precio">$<?php
                        $precio = (float)$producto['precio'];
                        echo number_format($precio,0,".",","); 
                    ?></p>
                    <a href="https://startoys.shop/producto.php?id=<?php echo $producto['id_producto']; ?>" class="ver-mas">Ver más</a>
                </div>
            <?php } ?>
        </div>
        <a href="https://startoys.shop/colecciones/accesorios/" class="ver-mas">Ver Colección</a>
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


    