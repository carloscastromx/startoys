<?php 

    session_start();

    if(isset($_SESSION["loggeado"])){
        header("Location: cuenta.php");
        exit();
    }

    if(isset($_POST["login"])){
        $email = $_POST["correo"];
        $pass = $_POST["contra"];

        $server = "localhost";
        $user= "u976611399_2GwXe";
        $pass_bd = "fJSw8NDd";
        $bd = "u976611399_startoys";

        $conexion = new mysqli($server,$user,$pass_bd,$bd);

        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = "SELECT id_usuario FROM Usuarios WHERE correo ='$email' AND contraseña = '$pass'";
            
            $datos = $conexion->query($sql);

            if($datos->num_rows > 0){
                $_SESSION["loggeado"] = '1';
                $_SESSION["correo"] = $email;
                exit("exito");
            } else {
                exit("fail");
            }
            
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
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="./Star Toys.svg" alt="Logo" class="logo">
        <nav>
            <a class="inicio" href="./index.html">Inicio</a>
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
    <form method="post" action="login.php">
        <div class="centrado">
            <h2 class="espacio">Inicio de Sesión</h2>
            <input type="email" id="correo" placeholder="Correo electrónico*" maxlength="50" required class="cuadrotexto espacio"> <br>
            <input type="password" id="contra" placeholder="Contraseña*" maxlength="50" required class="cuadrotexto espacio"> <br>
            <p>¿Aún no tienes una cuenta? <a href="registro.php">Regístrate</a></p>
            <input type="button" value="Iniciar Sesión" id="btn-login" class="BTN-carrito"><br>
        </div>
    </form>
    <p id="error-msg" class="espacio centrado"></p>
    <script>
        $(document).ready(function(){

            $("#btn-login").on('click', function(){
                var email = $("#correo").val();
                var pass = $("#contra").val();

                if(email == "" || pass == ""){
                    $("#error-msg").css("color","red");
                    $("#error-msg").html("Ingresa los datos solicitados para iniciar sesión");
                } else {
    
                    $("#error-msg").html("");
                    $.ajax(
                        {
                            url:'login.php',
                            method: 'POST',
                            data: {
                                login: 1,
                                correo: email,
                                contra: pass
                            },
                            success: function(response){
                                if(response == "fail"){
                                    $("#error-msg").css("color","red");
                                    $("#error-msg").html("Datos incorrectos");
                                } else {
                                    $("#error-msg").css("color","green");
                                    $("#error-msg").html("Inicio de sesión exitoso...");
                                    setTimeout(() => window.location.href = "https://startoys.shop/cuenta.php", 1500);
                                }

                            },
                            dataType: 'text'
                        }
                    );
                    
                } 
                
            });

            });
    </script>
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
