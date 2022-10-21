<?php 
    session_start();

    if(!isset($_SESSION['loggeado']) || !isset($_SESSION['totalpedido'])){
        header("Location: https://startoys.shop/login.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $server = "localhost";
        $user= "u976611399_2GwXe";
        $pass_bd = "fJSw8NDd";
        $bd = "u976611399_startoys";

        $conexion = new mysqli($server,$user,$pass_bd,$bd);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $cupon_id = $_POST['cupon-id-val'];
        $_SESSION['cupon-usado'] = $cupon_id;

        $consulta = "SELECT * FROM Cupones WHERE id_cupon = '$cupon_id'";

        $resultados = mysqli_query($conexion,$consulta);
        //Convertir a arreglos para iteración
        $datos = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

        mysqli_free_result($resultados);

        mysqli_close($conexion);

        $cant_cupon = 0;

        if(count($datos) >= 1){
            $_SESSION['descuento-aplicado'] = 1;
            foreach($datos as $d){
                $cant_cupon = (float)$d['descuento'];
                $_SESSION['descuentocant'] = $cant_cupon;
            }
            $resultado_val = 1;
        } else {
            $resultado_val = 0;
        }        

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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
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
    <section>
        <?php if($resultado_val == 1){ ?>
            <h2>Cupon aplicado exitosamente</h2>
        <?php } else { ?>
            <h2>El cupon ingresado no existe</h2>
        <?php } ?>
        <a href="https://startoys.shop/checkout/">Regresar a Finalizar Pedido</a>
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
