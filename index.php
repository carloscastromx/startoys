<?php 

    $server = "localhost";
    $user= "u976611399_2GwXe";
    $pass_bd = "fJSw8NDd";
    $bd = "u976611399_startoys";

    $conexion = new mysqli($server,$user,$pass_bd,$bd);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    } else {
        //Consulta para productos más recientes (ID más grande == Producto más reciente)
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM `Productos` ORDER BY id_producto DESC LIMIT 4";
        $resultados = mysqli_query($conexion,$consulta);
        //Convertir a arreglos para iteración
        $productos = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

        mysqli_free_result($resultados);

        mysqli_close($conexion);

        $colecciones = array("", "Muñecas", "Casas", "Accesorios");
        
    }

?>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Toys</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Raleway:wght@500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="./Star Toys.svg" alt="Logo" class="logo">
        <nav>
            <a class="inicio" href="https://startoys.shop/">Inicio</a>
            <a class="colecciones" href="https://startoys.shop/colecciones/">Colecciones</a>
            <a class="productos" href="https://startoys.shop/productos/">Productos</a>
        </nav>
        <div class="icons">
            <a href="./login.php">
                <img src="./Usuario.svg" alt="Usuario" class="usuario">
            </a>
            <a href="https://startoys.shop/carrito/">
                <img src="https://startoys.shop/Carrito.svg" alt="Carrito" class="carrito"> 
            </a>
        </div>
    </header>        
    <div class="banner">banner</div>
    <h2 class="nuevop">Nuevos Productos</h2>
    <div class="productos-nuevos">
        <?php foreach($productos as $producto){ ?>
                <div class="producto-nuevo-box">
                <div class="imagen">
                    <img src="https://startoys.shop/imgs/<?php echo $producto['imagen']; ?>">
                </div>
                <p class="textocuadro"><?php echo $producto['nombre']; ?></p>
                <p class="coleccion-p-txt"><?php echo $colecciones[$producto['coleccion']]; ?></p>
                <p class="precio">$<?php
                    $precio = (float)$producto['precio'];
                    echo number_format($precio,0,".",","); 
                 ?></p>
                <a href="https://startoys.shop/producto.php?id=<?php echo $producto['id_producto']; ?>" class="ver-mas">Ver más</a>
            </div>
        <?php } ?>
    </div>
    <div class="colecciones-box">
        <div class="coleccionestitulo">
            <div class="textoizquierda">
                <h2>Casas</h2>
                <p class="texto">Etiam vel maximus erat, ac maximus enim. Vivamus ultricies quis metus quis posuere. Suspendisse dignissim augue leo, non pharetra tortor vulputate ac. Phasellus cursus pretium accumsan. Phasellus nec arcu arcu. </p>
                <a href="https://startoys.shop/colecciones/casas/" class="ver-mas">Ver productos</a>
            </div>
            <div class="imagen-producto">
                <img src="./coleccion-casas.jpeg" alt="Casas">
            </div>
        </div>
        <div class="coleccionestitulo">
            <div class="textoizquierda">
                <h2>Muñecas</h2>
                <p class="texto">Etiam vel maximus erat, ac maximus enim. Vivamus ultricies quis metus quis posuere. Suspendisse dignissim augue leo, non pharetra tortor vulputate ac. Phasellus cursus pretium accumsan. Phasellus nec arcu arcu. </p>
                <a href="https://startoys.shop/colecciones/munecas/" class="ver-mas">Ver productos</a>
            </div>
            <div class="imagen-producto">
                <img src="./coleccion-munecas.jpeg" alt="Muñecas">
            </div>
        </div>
        <div class="coleccionestitulo">
            <div class="textoizquierda">
                <h2>Accesorios</h2>
                <p class="texto">Etiam vel maximus erat, ac maximus enim. Vivamus ultricies quis metus quis posuere. Suspendisse dignissim augue leo, non pharetra tortor vulputate ac. Phasellus cursus pretium accumsan. Phasellus nec arcu arcu. </p>
                <a href="https://startoys.shop/colecciones/accesorios/" class="ver-mas">Ver productos</a>
            </div>
            <div class="imagen-producto">
                <img src="./coleccion-accesorios.jpeg" alt="Accesorios">
            </div>
        </div>
    </div>   
    <footer class="final">
        <div>
            <p>Star Toys © 2022. Todos los derechos reservados </p>
        </div>
        <div class="icons">
            <a href="#">
                <img src="./icon-facebook.svg" alt="Facebook" class="usuario">
            </a>
            <a href="#">
                <img src="./icon-instagram.svg" alt="Instagram" class="carrito"> 
            </a>
        </div>
        
    </footer>
</body>
</html>


    