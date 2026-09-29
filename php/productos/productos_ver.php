<?php
require_once "../../config/conexion.php";

$sql = "SELECT id, nombre, precio, imagen, categoria, marca, stock FROM productos";
$resultado = $conexion->query($sql);

$productos = [];

while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila;
}

header("Content-Type: application/json");
echo json_encode($productos);
?>
