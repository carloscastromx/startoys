<?php 
    session_start();

    if(isset($_SESSION['loggeado'])){
        if(empty($_SESSION['carrito'])){
            $_SESSION['carrito'] = array();
        }
    
        if(!in_array($_GET['id'],$_SESSION['carrito'])){
            $existente = false;
            array_push($_SESSION['carrito'], $_GET['id']);
        } else {
            $existente = true;
        }
    } else {
        header("Location: login.php");
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
    <section class="main">
        <h2>
            <?php if($existente == false){
                echo "Producto agregado exitosamente";
            } else {
                echo "Ya habías agregado el producto a tu carrito";
            }
            ?>
        </h2>
        <a href="https://startoys.shop/carrito/">Ver carrito de compras</a>
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


    