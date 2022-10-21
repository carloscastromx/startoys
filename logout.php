<?php 

    session_start();

    if(!isset($_SESSION["loggeado"])){
        header("Location: login.php");
        exit();
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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
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
            <img src="./Usuario.svg" alt="Usuario" class="usuario">
            <a href="https://startoys.shop/carrito/">
                <img src="https://startoys.shop/Carrito.svg" alt="Carrito" class="carrito"> 
            </a>
        </div>
    </header>        
    <div class="centrado">
            <p>¿Estás seguro que quieres cerrar sesión?</p>
            <a href="./logout-action.php">Confirmar</a>
        </div>
</body>
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
</html>
