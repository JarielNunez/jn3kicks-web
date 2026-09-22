<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include (__DIR__ . "/../../config/conexion.php");

    $carrito_id = $_POST["carrito_id"];
    $nueva_cantidad = $POST["cantidad"];

    $consulta = "UPDATE carrito SET cantidad = '$nueva_cantidad' where id = '$carrito_id'";

    if ($conexion->query($consulta)){
    echo "Cantidad actualizada";
    } else {
    echo "Error: " . $conexion->error;
    }

?>    