<?php
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = "";
    $basedatos = "jn3kicks";

    $conexion = new mysqli($servidor, $usuario, $contraseña, $basedatos);

    if ($conexion->connect_error) {
        die("Error de conexion:" . $conexion->connect_error);

    }
?>

