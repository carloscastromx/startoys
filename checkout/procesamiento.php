<?php 
    session_start();

    if(!isset($_SESSION['loggeado']) || !isset($_SESSION['totalpedido'])){
        header("Location: https://startoys.shop/login.php");
    }

    if(isset($_GET['finalizado'])){

        $server = "localhost";
        $user= "u976611399_2GwXe";
        $pass_bd = "fJSw8NDd";
        $bd = "u976611399_startoys";

        $conexion = new mysqli($server,$user,$pass_bd,$bd);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $ids = implode(",", $_SESSION['carrito']);

        //Saber si se usó cupon{
            if(isset($_SESSION['descuento-aplicado'])){
                $cupon_usado = $_SESSION['cupon-usado'];
            } else {
                $cupon_usado = "NULL";
            }
        
        $mail_cliente = $_SESSION["correo"];

        //obtener ID de cliente
        $sql = "SELECT id_usuario FROM Usuarios WHERE correo = '$mail_cliente'";

        $resultados = mysqli_query($conexion,$sql);
        if($resultados == false){
            die(mysqli_error($conexion));
        }
        //Convertir a arreglos para iteración
        $id_usuario = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

        mysqli_free_result($resultados);

        foreach($id_usuario as $id){
            $id_cliente = $id['id_usuario'];
        }

        $fecha_pedido = date('Y-m-d');

        $total = $_SESSION['totalpedido'];

        //Crear pedido en tabla Pedidos

        if($cupon_usado == "NULL"){
            $sql = "INSERT INTO Pedidos(id_usuario, fecha, envio, id_cupon, total)
            VALUES('$id_cliente', '$fecha_pedido', 0, $cupon_usado, '$total')";
        } else {
            $sql = "INSERT INTO Pedidos(id_usuario, fecha, envio, id_cupon, total)
            VALUES('$id_cliente', '$fecha_pedido', 0, '$cupon_usado', '$total')";
        }

        $datos = mysqli_query($conexion,$sql);

        if($datos == false){
            die(mysqli_error($conexion));
        }

        mysqli_free_result($datos);

        //Crear registros en DetallePedidos

        //Obtener el ID del pedido más reciente (pedido creado anteriormente)
        $sql = "SELECT id_pedido FROM Pedidos ORDER BY id_pedido DESC LIMIT 1";
        $datos = mysqli_query($conexion,$sql);

        if($datos == false){
            die(mysqli_error($conexion));
        }
        //Convertir a arreglos para iteración
        $id_pedido_sql = mysqli_fetch_all($datos,MYSQLI_ASSOC);

        foreach($id_pedido_sql as $id_pedido){
            $pedido_id = $id_pedido['id_pedido'];
        }

        mysqli_free_result($datos);

        //Obtener datos de productos
        $sql = "SELECT id_producto, precio FROM Productos WHERE id_producto IN ($ids)";

        $datos = mysqli_query($conexion,$sql);

        if($datos == false){
            die(mysqli_error($conexion));
        }
        //Convertir a arreglos para iteración
        $productos_sql = mysqli_fetch_all($datos,MYSQLI_ASSOC);

        mysqli_free_result($datos);

        foreach($productos_sql as $prod){
            $precio_p = $prod['precio'];
            $id_p = $prod['id_producto'];
            $sql = "INSERT INTO DetallePedidos(id_pedidos, id_producto, cant, subtotal)
            VALUES('$pedido_id', '$id_p', 1, '$precio_p')";

            $datos = mysqli_query($conexion,$sql);
            if($datos == false){
                die(mysqli_error($conexion));
            }

            mysqli_free_result($datos);
        }

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
    <section style="text-align: center;padding:20px;">
        <h2>Pedido completado correctamente</h2>
        <a href="https://startoys.shop/cuenta.php">Ir a mi cuenta</a>
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
