<?php
declare(strict_types=1);

// Ubicación: api/auth/registrar.php
header('Content-Type: application/json; charset=utf-8');

// Hace que los errores de mysqli lancen excepciones (así siempre respondemos en JSON)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function responder(int $codigo, bool $exito, string $mensaje): void
{
    http_response_code($codigo);
    echo json_encode(['exito' => $exito, 'mensaje' => $mensaje], JSON_UNESCAPED_UNICODE);
    exit;
}

// 1. Solo se acepta POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    responder(405, false, 'Método no permitido');
}

// 2. Leer el cuerpo JSON
$datos = json_decode(file_get_contents('php://input'), true);
if (!is_array($datos)) {
    responder(400, false, 'Petición inválida');
}

$nombre     = trim((string)($datos['nombre'] ?? ''));
$correo     = strtolower(trim((string)($datos['correo'] ?? '')));
$contrasena = (string)($datos['contrasena'] ?? '');
$terminos   = !empty($datos['terminos']);

// 3. Validar (el servidor siempre revalida, aunque el JS ya lo haga)
if ($nombre === '' || mb_strlen($nombre) > 100) {
    responder(422, false, 'Ingresa un nombre válido (máx. 100 caracteres).');
}
if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || mb_strlen($correo) > 150) {
    responder(422, false, 'Ingresa un correo válido.');
}
if (strlen($contrasena) < 8) {
    responder(422, false, 'La contraseña debe tener al menos 8 caracteres.');
}
if (strlen($contrasena) > 72) {
    // bcrypt ignora todo lo que pase de 72 bytes
    responder(422, false, 'La contraseña no puede superar los 72 caracteres.');
}
if (!$terminos) {
    responder(422, false, 'Debes aceptar los términos para continuar.');
}

try {
    // Tu conexión (define $conexion)
    require_once __DIR__ . '/../../config/conexion.php';
    $conexion->set_charset('utf8mb4');

    // 4. Verificar que el correo no exista
    $stmt = $conexion->prepare('SELECT id FROM usuarios WHERE correo = ? LIMIT 1');
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $stmt->store_result();
    $existe = $stmt->num_rows > 0;
    $stmt->close();

    if ($existe) {
        responder(409, false, 'Ya existe una cuenta con ese correo.');
    }

    // 5. Guardar con la contraseña encriptada (bcrypt -> $2y$10$...)
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare('INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $nombre, $correo, $hash);
    $stmt->execute();
    $stmt->close();

    responder(201, true, 'Cuenta creada correctamente.');

} catch (mysqli_sql_exception $e) {
    // 1062 = entrada duplicada (dos registros a la vez con el mismo correo)
    if ($e->getCode() === 1062) {
        responder(409, false, 'Ya existe una cuenta con ese correo.');
    }
    error_log('Error en registrar.php: ' . $e->getMessage());
    responder(500, false, 'Error del servidor. Inténtalo más tarde.');
}