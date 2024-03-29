<?php

    if(isset($_POST["registro"])){
        $server = "localhost";
        $user= "u976611399_2GwXe";
        $pass_bd = "fJSw8NDd";
        $bd = "u976611399_startoys";

        $conexion = new mysqli($server,$user,$pass_bd,$bd);

        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        } else {
            $email = $conexion->real_escape_string($_POST["correo"]);
            //Checar si correo ya existe en BD

            $sql = "SELECT * From Usuarios WHERE correo = '$email'";
            $resultados = mysqli_query($conexion,$sql);
            $cantidad = mysqli_num_rows($resultados);

            mysqli_free_result($resultados);

            if($cantidad >= 1){
                exit("existente");
            } else {

            }

            $name = $conexion->real_escape_string($_POST["nombre"]);
            $username = $conexion->real_escape_string($_POST["user"]);
            $pass = $conexion->real_escape_string($_POST["contra"]);
            $sexo = $conexion->real_escape_string($_POST["sex"]);
            $fecha_nac = $conexion->real_escape_string($_POST["fnac"]);
            $ciudad = $conexion->real_escape_string($_POST["city"]);
            $calle = $conexion->real_escape_string($_POST["ncalle"]);
            $n_int = $conexion->real_escape_string($_POST["nint"]);
            $n_ext = $conexion->real_escape_string($_POST["next"]);
            $codigo_p = $conexion->real_escape_string($_POST["cp"]);

            $sql = "INSERT INTO Usuarios(nombre, nombre_de_usuario, contraseña, correo, sexo, fecha_nac, ciudad, calle, num_ext, num_int, codigo_postal)
            VALUES('$name', '$username', '$pass', '$email', '$sexo', '$fecha_nac', '$ciudad', '$calle', '$n_ext', '$n_int', '$codigo_p')";

            $datos = $conexion->query($sql);
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
    <?php echo $cantidad; ?>
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
    <form method="post" action="registro.php">
        <div class="centrado" style="width:80%;margin:auto;">
            <h2 class="espacio">Registro de usuario</h2>
            <input type="text" id="nombre" placeholder="Nombre y Apellido*" maxlength="50" required class="cuadrotexto espacio"> <br>
            <input type="text" id="usuario" placeholder="Nombre de usuario*" maxlength="15" required class="cuadrotexto espacio"> <br>
            <input type="password" id="contra" placeholder="Contraseña*" maxlength="50" required class="cuadrotexto espacio"> <br>
            <input type="email" id="correo" placeholder="Correo electrónico*" maxlength="50" required class="cuadrotexto espacio"> <br>
            <div class="espacio" style="width:500px;margin:auto;">
                <div class="cuadro izquierda">
                    <p>Sexo*</p> <br>
                    <input type="radio" name="sexo" id="sexo-hombre" />  Hombre
                    <input type="radio" name="sexo" id="sexo-mujer"/>  Mujer
                    <input type="radio" name="sexo" id="sexo-otro"/>  Otro <br>
                </div>
            </div>
            <div class="espacio" style="width:500px;margin:auto;">
                <div class="cuadro izquierda">
                    <p>Fecha de nacimiento*</p>
                    <input type="date" placeholder="Fecha de Nacimiento" id="fecha_n" required class="cuadrotexto espacio"> <br>
                </div>
            </div>
            <input type="text" placeholder="Ciudad*" maxlength="50" id="ciudad" required class="cuadrotexto espacio"> <br>
            <input type="text" placeholder="Calle*" maxlength="50" id="calle" required class="cuadrotexto espacio"> <br>
            <input type="text" placeholder="Numero exterior*" id="n_ext" maxlength="50" required class="cuadrotexto espacio"> <br>
            <input type="text" placeholder="Numero interior*" id="n_int" maxlength="50" required class="cuadrotexto espacio"> <br>
            <input type="text" placeholder="Código Postal*" id="cp" maxlength="8" required class="cuadrotexto espacio"> <br>
            <p class="txt-cuenta-existente">¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión</a></p>
            <input type="button" value="Registarme" id="btn-registro" class="espacio registro"><br>
        </div>
    </form>
    <p id="error-msg" class="espacio centrado"></p>
    <script>
        $(document).ready(function(){
            $("#error-msg").css("color","red");
            var sexo;
            $("#sexo-hombre").change(function(){
                if($("#sexo-hombre").is(":checked")){
                    sexo = "H";
                }
            });

            $("#sexo-mujer").change(function(){
                if($("#sexo-mujer").is(":checked")){
                    sexo = "M";
                }
            });

            $("#sexo-otro").change(function(){
                if($("#sexo-otro").is(":checked")){
                    sexo = "O";
                }
            });

            $("#btn-registro").on('click', function(){
                var name = $("#nombre").val();
                var usuario = $("#usuario").val();
                var pass = $("#contra").val();
                var email = $("#correo").val();
                var nac = $("#fecha_n").val();
                var ciudad = $("#ciudad").val();
                var calle = $("#calle").val();
                var num_int = $("#n_int").val();
                var num_ext = $("#n_ext").val();
                var codigo_postal = $("#cp").val();

                if(name == "" || pass == "" || email == "" || nac == "" || ciudad == "" || calle == "" || num_ext == "" | codigo_postal == ""){
                    $("#error-msg").html("Completa los campos obligatorios");
                } else {
                    if(sexo != "H" && sexo != "M" && sexo != "O"){
                        $("#error-msg").html("Completa los campos obligatorios");
                    } else {
                        $("#error-msg").html("");
                        $.ajax(
                            {
                                url:'registro.php',
                                method: 'POST',
                                data: {
                                    registro: 1,
                                    nombre: name,
                                    user: usuario,
                                    contra: pass,
                                    correo: email,
                                    sex: sexo,
                                    fnac: nac,
                                    city: ciudad,
                                    ncalle: calle,
                                    nint: num_int,
                                    next: num_ext,
                                    cp: codigo_postal
                                },
                                success: function(response){
                                    if(response == "existente"){
                                        $("#error-msg").css("color","red");
                                        $("#error-msg").html("El correo ingresado ya está registrado");
                                    } else {
                                        $("#error-msg").css("color","green");
                                        $("#error-msg").html("Usuario registrado exitosamente");
                                    }

                                },
                                dataType: 'text'
                            }
                        );
                    }
                } 
                
            });

            });
    </script>
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
