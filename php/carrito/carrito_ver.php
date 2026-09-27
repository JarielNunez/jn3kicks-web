<?php
    header('Content-Type: application/json');
    include(__DIR__ . "/../../config/conexion.php");

    $usuario_id = 1;

    $consulta = "SELECT carrito.id, productos.nombre, productos.precio, carrito.cantidad
                 FROM carrito
                 JOIN productos ON carrito.producto_id = productos.id
                 WHERE carrito.usuario_id = '$usuario_id'";

    $resultado = $conexion->query($consulta);

    $articulos = array();

    while ($fila = $resultado->fetch_assoc()) {
        $articulos[] = $fila;
    }

    echo json_encode($articulos);
?>