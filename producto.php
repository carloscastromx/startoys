<?php 
    if(!isset($_GET["id"])){
        header("Location: index.php");
        exit();
    } else {

        $id_prod = $_GET["id"];

        $server = "localhost";
        $user= "u976611399_2GwXe";
        $pass_bd = "fJSw8NDd";
        $bd = "u976611399_startoys";

        $conexion = new mysqli($server,$user,$pass_bd,$bd);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        } else {
            //Consulta para detalles de producto
            $consulta = "SELECT Productos.nombre, Productos.id_producto, Productos.descripcion, Productos.imagen, Productos.precio , Productos.coleccion, Marcas.nombre as marca FROM Productos INNER JOIN Marcas on Marcas.id_marca = Productos.id_marca WHERE id_producto = '$id_prod'";
            $resultados = mysqli_query($conexion,$consulta);
            //Convertir a arreglos para iteración
            $datos = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

            mysqli_free_result($resultados);

            mysqli_close($conexion);

            $colecciones = array("", "Muñecas", "Casas", "Accesorios");
            $links_colecciones = array("", "https://startoys.shop/colecciones/munecas/", "https://startoys.shop/colecciones/casas/", "https://startoys.shop/colecciones/accesorios/");

            foreach($datos as $d){
                $titulo_html = $d['nombre'];
            }
            
        }
    }
?>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_html; ?> | Star Toys</title>
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
    <?php foreach($datos as $dato){ ?>
    <section class="breadcrumbs">
        <nav>
            <a href="https://startoys.shop/">Inicio</a> / 
            <a href="<?php echo $links_colecciones[$dato['coleccion']]; ?>"><?php echo $colecciones[$dato['coleccion']]; ?></a> / 
            <a href="#"><?php echo $dato['nombre']; ?></a>
        </nav>
    </section>
    <section class="producto-template">
        <div class="detalles-col">
            <div class="img-producto-landing">
                <img src="https://startoys.shop/imgs/<?php echo $dato['imagen']; ?>" alt="<?php echo $dato['nombre'] ?>" class="cuadro">
            </div>
            <div class="datos-producto">
                <h1 class="titulo-producto"><?php echo $dato['nombre']; ?></h1>
                <p class="detalle-producto gris"><span>Marca: </span><?php echo $dato['marca']; ?></p>
                <p class="detalle-producto gris"><span>Colección: </span><?php echo $colecciones[$dato['coleccion']]; ?></p>
                <div class="div-precio-btn">
                    <p class="precio-producto">$<?php
                            $precio = (float)$dato['precio'];
                            echo number_format($precio,0,".",","); 
                        ?>
                    </p> 
                    <a href="https://startoys.shop/agregar-carrito.php?id=<?php echo $dato['id_producto']; ?>" class="BTN-carrito">Agregar al carrito</a>
                </div>
            </div>
        </div>
        <div class="descripcion-box">
            <h3 class="descripcion-h">Descripcion</h3>
            <p class="descripcion-txt">
                <?php echo $dato['descripcion']; ?>
            </p>
        </div>
        <?php } ?>
        
    </section>
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


    