<?php 
$server = "localhost";
$user= "u976611399_2GwXe";
$pass_bd = "fJSw8NDd";
$bd = "u976611399_startoys";

//precio max 5299
//precio min 79

$conexion = new mysqli($server,$user,$pass_bd,$bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    //Obtener marcas para colocarlas en filtros
    $consulta = "SELECT id_marca, nombre FROM Marcas";

    $resultados = mysqli_query($conexion,$consulta);
    $marcas = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

    mysqli_free_result($resultados);
    //Consulta para productos ordenados por más recientes (ID más grande == Producto más reciente)
    $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos ORDER BY id_producto DESC";
    $resultados = mysqli_query($conexion,$consulta);
    //Convertir a arreglos para iteración
    $productos = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

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
    <section class="main-productos">
        <h1>Productos</h1>
        <div class="productos-col">
            <div class="filtros">
                <form method="GET">
                    <label class="filtro-titulo">Colección</label>
                    <input type="radio" name="coleccion" value="casas"> Casas
                    <input type="radio" name="coleccion" value="munecas"> Muñecas
                    <input type="radio" name="coleccion" value="accesorios"> Accesorios
                    <label class="filtro-titulo">Marca</label>
                    <?php foreach($marcas as $marca) { ?>
                        <label>
                            <input type="checkbox" name="marca" value="<?php echo $marca['id_marca']; ?>">
                            <?php echo $marca['nombre']; ?>
                        </label>
                    <?php } ?>
                    <label class="filtro-titulo">Precio</label>
                    <input type="radio" name="precio" id="" value="menos-100"> Menos de $100
                    <input type="radio" name="precio" id="" value="100-300"> $100 - 300
                    <input type="radio" name="precio" id="" value="300-600"> $300 - $600
                    <input type="radio" name="precio" id="" value="600-1000"> $600 - $1,000
                    <input type="radio" name="precio" id="" value="1000-1500"> $1,000 - $1,500
                    <input type="radio" name="precio" id="" value="mas-1500"> Más de $1,500
                    <!-- <input type="button" value="Aplicar" id="btn-filtrar"> -->
                </form>
            </div>
            <div class="productos-cont">
                <p class="cantidad-resultados">Mostrando <?php echo $cantidad; ?> productos disponibles</p>
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
            </div>
        </div>
    </section>
    <script>
        /*
        $(document).ready(function(){

            $("#btn-filtrar").on('click', function(){
                var email = $("#correo").val();
                var pass = $("#contra").val();

                if(email == "" || pass == ""){
                    $("#error-msg").css("color","red");
                    $("#error-msg").html("Ingresa los datos solicitados para iniciar sesión");
                } else {
    
                    $("#error-msg").html("");
                    $.ajax(
                        {
                            url:'index.php',
                            method: 'GET',
                            data: {
                                correo: email,
                                contra: pass
                            },
                            success: function(response){
                                if(response == "fail"){
                                    $("#error-msg").css("color","red");
                                    $("#error-msg").html("Datos incorrectos");
                                } else {
                                    $("#error-msg").css("color","green");
                                }

                            },
                            dataType: 'text'
                        }
                    );
                    
                } 
                
            });

            });*/
    </script>
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


    