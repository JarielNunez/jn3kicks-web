<?php
    include(__DIR__ . "/../config/conexion.php");

    //Por ahora, usuario fijo de prueba (luego sera $_SESSION["usuario_id"])
    $usuario_id =1;

    $producto_id = $_POST["producto_id"];
    $cantidad = $_POST["cantidad"];

    $consulta = "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ('$usuario_id', '$producto_id', '$cantidad')";

    if ($conexion->query($consulta)) {
        echo "Producto agregado al carrito correctamente.";
    } else {
        echo "Error: " . $conexion->error;
    }
?>    