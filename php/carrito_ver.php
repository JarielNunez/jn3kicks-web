<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include(__DIR__ . "/../config/conexion.php");

    $usuario_id = 1; // Por ahora, usuario fijo de prueba (luego sera $_SESION["usuario_id"])

    $consulta = "SELECT carrito.id, productos.nombre, productos.precio, carrito.cantidad 
    FROM carrito
    JOIN productos ON carrito.producto_id = productos.id
    WHERE carrito.usuario_id = '$usuario_id'";

    $resultado = $conexion->query($consulta);

    while ($fila = $resultado->fetch_assoc()) {
        echo "<div class='carrito-item'>";
        echo "<span>" . $fila["nombre"] . "</span>";
        echo "<span>$" . $fila["precio"] . "</span>";
        echo "<span>" . $fila["cantidad"] . "</span>";
        echo "</div>";   
    
    }

?>    