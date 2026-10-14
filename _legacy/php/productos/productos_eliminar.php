<?php
require_once "../../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["exito" => true, "mensaje" => "Producto eliminado correctamente"]);
    } else {
        echo json_encode(["exito" => false, "mensaje" => "Error al eliminar: " . $stmt->error]);
    }

    $stmt->close();
}
?>
