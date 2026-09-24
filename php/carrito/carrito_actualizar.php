<?php
    header('Content-Type: application/json');
    include(__DIR__ . "/../../config/conexion.php");

    $carrito_id = $_POST["carrito_id"];
    $nueva_cantidad = intval($_POST["cantidad"]);

    // Validación del lado del servidor: nunca menos de 1
    if ($nueva_cantidad < 1) {
        echo json_encode(["exito" => false, "mensaje" => "La cantidad debe ser al menos 1"]);
        exit;
    }

    $consulta = "UPDATE carrito SET cantidad = '$nueva_cantidad' WHERE id = '$carrito_id'";

    if ($conexion->query($consulta)) {
        echo json_encode(["exito" => true]);
    } else {
        echo json_encode(["exito" => false, "error" => $conexion->error]);
    }
?>