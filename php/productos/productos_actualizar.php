<?php
require_once "../../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];
    $categoria = $_POST["categoria"];
    $marca = $_POST["marca"];
    $genero = $_POST["genero"];
    $stock = $_POST["stock"];

    $sql = "UPDATE productos SET nombre = ?, precio = ?, imagen = ?, categoria = ?, marca = ?, genero = ?, stock = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sdsssiii", $nombre, $precio, $imagen, $categoria, $marca, $genero, $stock, $id);

    if ($stmt->execute()) {
        echo json_encode(["exito" => true, "mensaje" => "Producto actualizado correctamente"]);
    } else {
        echo json_encode(["exito" => false, "mensaje" => "Error al actualizar: " . $stmt->error]);
    }

    $stmt->close();
}
?>
