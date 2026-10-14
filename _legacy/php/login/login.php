<?php

session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/conexion.php';

// Solo aceptamos POST. Si alguien intenta GET, lo rechazamos.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
    exit;
}

// Leemos el cuerpo de la petición como JSON.
$datos = json_decode(file_get_contents('php://input'), true);

$correo     = trim($datos['correo'] ?? '');
$contrasena = $datos['contrasena'] ?? '';

// Validación básica de campos vacíos.
if ($correo === '' || $contrasena === '') {
    http_response_code(400); // Bad Request
    echo json_encode(['exito' => false, 'mensaje' => 'Correo y contraseña son obligatorios']);
    exit;
}

// Buscamos al usuario por correo usando una consulta PREPARADA.
$sql = "SELECT id, nombre, correo, contrasena, fecha_registro FROM usuarios WHERE correo = ? LIMIT 1";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('s', $correo);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$stmt->close();

// Si no existe el usuario, respondemos con el MISMO mensaje genérico
if (!$usuario) {
    http_response_code(401); // Unauthorized
    echo json_encode(['exito' => false, 'mensaje' => 'Credenciales incorrectas']);
    exit;
}

// Aquí está el corazón de la seguridad: password_verify() toma la
if (!password_verify($contrasena, $usuario['contrasena'])) {
    http_response_code(401);
    echo json_encode(['exito' => false, 'mensaje' => 'Credenciales incorrectas']);
    exit;
}

// Login correcto: guardamos datos del usuario en la SESIÓN del
$_SESSION['usuario_id']     = $usuario['id'];
$_SESSION['usuario_nombre'] = $usuario['nombre'];

// Respondemos éxito. OJO: nunca devolvemos el hash de la contraseña
echo json_encode([
    'exito'   => true,
    'mensaje' => 'Inicio de sesión exitoso',
    'usuario' => [
        'id'             => $usuario['id'],
        'nombre'         => $usuario['nombre'],
        'correo'         => $usuario['correo'],
        'fecha_registro' => $usuario['fecha_registro'],
    ],
]);