<?php 
    
    session_start();

    unset($_SESSION["loggeado"]);
    session_destroy();
    header(("Location: login.php"));
    exit();

?>