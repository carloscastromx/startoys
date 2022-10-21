<?php 
$server = "localhost";
$user= "u976611399_2GwXe";
$pass_bd = "fJSw8NDd";
$bd = "u976611399_startoys";

$conexion = new mysqli($server,$user,$pass_bd,$bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    //Obtener marcas para colocarlas en filtros
    $consulta = "SELECT id_marca, nombre FROM Marcas";

    $resultados = mysqli_query($conexion,$consulta);
    $marcas = mysqli_fetch_all($resultados,MYSQLI_ASSOC);

    mysqli_free_result($resultados);

    $f_precio = false;
    $f_marca = false;
    $f_coleccion = false;

    if(isset($_GET["precio"])){
        $f_precio = true;
        $filtro_precio = $_GET["precio"];
        switch ($filtro_precio){
            case "menos-100":
                $precio_sql = "precio < 100";
                break;
            case "100-300":
                $precio_sql = "precio BETWEEN 100 AND 300";
                break;
            case "300-600":
                $precio_sql = "precio BETWEEN 300 AND 600";
                break;
            case "600-1000":
                $precio_sql = "precio BETWEEN 600 AND 1000";
                break;
            case "1000-1500":
                $precio_sql = "precio BETWEEN 1000 AND 1500";
                break;
            case "mas-1500":
                $precio_sql = "precio >= 1500";
                break; 
        } 
    }

    if(isset($_GET["coleccion"])){
        $f_coleccion = true;
        $filtro_coleccion = $_GET["coleccion"];

        switch ($filtro_coleccion){
            case "casas":
                $coleccion_sql = "coleccion = 2";
                break;
            case "munecas":
                $coleccion_sql = "coleccion = 1";
                break;
            case "accesorios":
                $coleccion_sql = "coleccion = 3";
                break;
        }
    }

    if(isset($_GET["marca"])){
        $f_marca = true;
        $query  = explode('&', $_SERVER['QUERY_STRING']);
        $params = array();
        
        foreach( $query as $param )
        {
            if (strpos($param, '=') === false) $param += '=';

            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        }

        $filtro_marca = $params['marca'];
        $terminos_marca = implode(",", $filtro_marca);

        $marca_sql = "id_marca in ('$terminos_marca')";
    }

    //Armar consulta

    //Sin filtros
    if($f_coleccion == false && $f_marca == false && $f_precio == false){
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos ORDER BY id_producto DESC";
    }

    //Filtro individual coleccion
    if($f_coleccion == true && $f_marca == false && $f_precio == false){
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos WHERE ";
        $consulta .= $coleccion_sql;
        //agregar el order by para productos mas recientes
        $consulta .= " ORDER BY id_producto DESC";
    }

    //Filtro individual marca
    if($f_marca == true && $f_coleccion == false && $f_precio == false){
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos WHERE ";
        $consulta .= $marca_sql;
        //agregar el order by para productos mas recientes
        $consulta .= " ORDER BY id_producto DESC";
    }

    //Filtro individual precio
    if($f_precio == true && $f_coleccion == false && $f_marca == false){
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos WHERE ";
        $consulta .= $precio_sql;
        //agregar el order by para productos mas recientes
        $consulta .= " ORDER BY id_producto DESC";
    }

     //Filtro Coleccion + Marca
     if($f_coleccion == true && $f_marca == true && $f_precio == false){
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos WHERE ";
        $consulta .= $coleccion_sql . " and " . $marca_sql;
        //agregar el order by para productos mas recientes
        $consulta .= " ORDER BY id_producto DESC";
    }

    //Filtro Coleccion + Precio
    if($f_coleccion == true && $f_marca == false && $f_precio == true){
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos WHERE ";
        $consulta .= $coleccion_sql . " and " . $precio_sql;
        //agregar el order by para productos mas recientes
        $consulta .= " ORDER BY id_producto DESC";
    }

    //Filtro Marca + Precio
    if($f_coleccion == false && $f_marca == true && $f_precio == true){
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos WHERE ";
        $consulta .= $marca_sql . " and " . $precio_sql;
        //agregar el order by para productos mas recientes
        $consulta .= " ORDER BY id_producto DESC";
    }

    //Filtro Coleccion + Marca + Precio
    if($f_coleccion == true && $f_marca == true && $f_precio == true){
        $consulta = "SELECT id_producto, nombre, imagen, precio, coleccion FROM Productos WHERE ";
        $consulta .= $coleccion_sql . " and " . $marca_sql . " and " . $precio_sql;
        //agregar el order by para productos mas recientes
        $consulta .= " ORDER BY id_producto DESC";
    }
    
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
                    <p>Filtros</p>
                    <hr>
                    <label class="filtro-titulo">Colección</label> <br>
                    <div class="filtros-centrados">
                        <div>
                            <input type="radio" name="coleccion" value="casas"> Casas 
                        </div>
                        <div>
                            <input type="radio" name="coleccion" value="munecas"> Muñecas 
                        </div> 
                        <div>
                            <input type="radio" name="coleccion" value="accesorios"> Accesorios <br>
                        </div>
                    </div>
                    <label class="filtro-titulo">Marca</label> <br>
                    <div class="filtros-centrados">
                        <?php foreach($marcas as $marca) { ?>
                            <label>
                                <input type="checkbox" name="marca" value="<?php echo $marca['id_marca']; ?>">
                                <?php echo $marca['nombre']; ?>
                            </label>
                        <?php } ?>
                    </div>
                    <label class="filtro-titulo">Precio</label>
                    <div class="filtros-centrados">
                        <div>
                            <input type="radio" name="precio" id="" value="menos-100"> Menos de $100
                        </div>
                        <div>
                            <input type="radio" name="precio" id="" value="100-300"> $100 - 300
                        </div>
                        <div>
                            <input type="radio" name="precio" id="" value="300-600"> $300 - $600
                        </div>
                        <div>
                            <input type="radio" name="precio" id="" value="600-1000"> $600 - $1,000
                        </div>
                        <div>
                            <input type="radio" name="precio" id="" value="1000-1500"> $1,000 - $1,500
                        </div>
                        <div>
                            <input type="radio" name="precio" id="" value="mas-1500"> Más de $1,500
                        </div>
                        <div>
                            <input type="submit" value="Aplicar" id="btn-filtrar">
                        </div> 
                    </div>
                    
                </form>
            </div>
            <div class="productos-cont">
                <p class="cantidad-resultados">Mostrando <?php echo $cantidad; ?> productos disponibles</p>
                <div class="productos-nuevos cant-<?php echo $cantidad; ?>">
                    <?php if($cantidad < 1){ ?>
                        <p>No hay productos que cumplan tus criterios de búsqueda</p>
                    <?php } ?>
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


    