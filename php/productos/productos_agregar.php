<?php
require_once "../../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];
    $categoria = $_POST["categoria"];
    $marca = $_POST["marca"];
    $genero = $_POST["genero"];
    $stock = $_POST["stock"];

    $sql = "INSERT INTO productos (nombre, precio, imagen, categoria, marca, genero, stock) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sdssssi", $nombre, $precio, $imagen, $categoria, $marca, $genero, $stock);

    if ($stmt->execute()) {
        echo json_encode(["exito" => true, "mensaje" => "Producto agregado correctamente"]);
    } else {
        echo json_encode(["exito" => false, "mensaje" => "Error al agregar: " . $stmt->error]);
    }

    $stmt->close();
}
?>
