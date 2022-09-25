<?php 

    $server = "localhost";
    $user= "u976611399_2GwXe";
    $pass_bd = "fJSw8NDd";
    $bd = "u976611399_startoys";

    $conexion = new mysqli($server,$user,$pass_bd,$bd);

    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $conexion->real_escape_string($_POST["nombre"]);
        $username = $conexion->real_escape_string($_POST["user"]);
        $pass = $conexion->real_escape_string($_POST["contra"]);
        $email = $conexion->real_escape_string($_POST["correo"]);
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

?>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Toys</title>
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One:regular" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="./Star Toys.svg" alt="Logo" class="logo">
        <nav>
            <a class="inicio" href="#">Inicio</a>
            <a class="colecciones" href="#">Colecciones</a>
            <a class="productos" href="#">Productos</a>
        </nav>
        <div class="icons">
            <a href="#">
                <img src="./Usuario.svg" alt="Usuario" class="usuario">
            </a>
            <a href="#">
                <img src="./Carrito.svg" alt="Carrito" class="carrito"> 
            </a>
        </div>
    </header>        
    <form method="post" action="registro.php">
        <input type="text" id="nombre" placeholder="Nombre y Apellido" maxlength="50" required>
        <input type="text" id="usuario" placeholder="Nombre de usuario" maxlength="15" required>
        <input type="password" id="contra" placeholder="Contraseña" maxlength="50" required>
        <input type="email" id="correo" placeholder="Correo electrónico" maxlength="50" required>
        <input type="radio" name="sexo-h" id="sexo-hombre">
        <label for="sexo-h">Hombre</label>
        <input type="radio" name="sexo-m" id="sexo-mujer">
        <label for="sexo-m">Mujer</label>
        <input type="radio" name="sexo-o" id="sexo-otro">
        <label for="sexo-o">Otro</label>
        <input type="date" placeholder="Fecha de Nacimiento" id="fecha_n" required>
        <input type="text" placeholder="Ciudad" maxlength="50" id="ciudad" required>
        <input type="text" placeholder="Calle" maxlength="50" id="calle" required>
        <input type="text" placeholder="Numero exterior" id="n_ext" maxlength="50" required>
        <input type="text" placeholder="Numero interior" id="n_int" maxlength="50" required>
        <input type="text" placeholder="Código Postal" id="cp" maxlength="8" required>
        <input type="button" value="Registarme" id="btn-registro">
    </form>
    <p id="error-msg"></p>
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
                

                if(sexo != "H" && sexo != "M" && sexo != "O"){
                    $("#error-msg").html("El campo sexo no puede estar vacío");
                } else {
                    if(name == "" || pass == "" || email == "" || nac == "" || ciudad == "" || calle == "" || num_int == "" || num_ext == "" | codigo_postal == ""){
                        $("#error-msg").html("Completa los campos obligatorios");
                    } else {
                        $("#error-msg").html("");
                        console.log(num_int);
                        $.ajax(
                            {
                                url:'registro.php',
                                method: 'POST',
                                data: {
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
                                    $("#error-msg").css("color","green");
                                    $("#error-msg").html("Usuario registrado exitosamente");

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
</html>

    