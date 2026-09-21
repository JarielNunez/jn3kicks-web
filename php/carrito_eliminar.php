<?php
    include(__DIR__ . "/../config/conexion.php");

    $carrito_id = $_POST["carrito_id"];

    $consulta = "DELETE FROM carrito where id = '$carrito_id'";

    if ($conexion->query($consulta)){
        echo "Producto eliminado del carrito";
    } else {
        echo "Error: " . $conexion->error;
    }

?>    