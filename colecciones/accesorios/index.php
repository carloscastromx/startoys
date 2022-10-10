<?php 

$server = "localhost";
$user= "u976611399_2GwXe";
$pass_bd = "fJSw8NDd";
$bd = "u976611399_startoys";

$conexion = new mysqli($server,$user,$pass_bd,$bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    //Consulta para obtener todos los productos
    //Accesorios -> Colección 3
    $consulta = "SELECT * FROM Productos WHERE coleccion = 3";
    $resultados = mysqli_query($conexion,$consulta);
    //Convertir a arreglos para iteración
    $prods = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

    $cantidad = mysqli_num_rows($resultados);

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
    <link rel="stylesheet" href="../../style.css">
</head>
<body class="coleccion-individual-page">
    <header>
        <img src="../../Star Toys.svg" alt="Logo" class="logo">
        <nav>
            <a class="inicio" href="https://startoys.shop/">Inicio</a>
            <a class="colecciones" href="https://startoys.shop/colecciones/">Colecciones</a>
            <a class="productos" href="https://startoys.shop/productos/">Productos</a>
        </nav>
        <div class="icons">
            <a href="../../login.php">
                <img src="../../Usuario.svg" alt="Usuario" class="usuario">
            </a>
            <a href="https://startoys.shop/carrito/">
                <img src="https://startoys.shop/Carrito.svg" alt="Carrito" class="carrito"> 
            </a>
        </div>
    </header>        
    <section class="main-colecciones-sp">
        <h1>Accesorios</h1>
        <p>Conoce todos los accesorios disponibles en Star Toys para tus casas y muñecas</p>
        <p class="cantidad-productos">Mostrando <?php echo $cantidad; ?> productos disponibles</p>
        <div class="productos-nuevos">
        <?php foreach($prods as $prod){ ?>
                <div class="producto-nuevo-box">
                <div class="imagen">
                    <img src="https://startoys.shop/imgs/<?php echo $prod['imagen']; ?>">
                </div>
                <p class="textocuadro"><?php echo $prod['nombre']; ?></p>
                <p class="precio">$<?php
                    $precio = (float)$prod['precio'];
                    echo number_format($precio,0,".",","); 
                 ?></p>
                <a href="https://startoys.shop/producto.php?id=<?php echo $prod['id_producto']; ?>" class="ver-mas">Ver más</a>
            </div>
        <?php } ?>
    </div>
    </section>
    <footer class="final">
        <div>
            <p>Star Toys © 2022. Todos los derechos reservados </p>
        </div>
        <div class="icons">
            <a href="#">
                <img src="../../icon-facebook.svg" alt="Facebook" class="usuario">
            </a>
            <a href="#">
                <img src="../../icon-instagram.svg" alt="Instagram" class="carrito"> 
            </a>
        </div>
        
    </footer>
</body>
</html>


    