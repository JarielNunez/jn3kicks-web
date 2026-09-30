<?php
/**
 * api/usuarios/verificar_sesion.php
 * -------------------------------------------------------------------
 * Cualquier página o API que necesite saber "¿hay alguien logueado?"
 * llama a este endpoint (o hace session_start() + revisa $_SESSION
 * directamente si está en el mismo servidor PHP).
 * -------------------------------------------------------------------
 */

session_start();
header('Content-Type: application/json; charset=utf-8');

if (isset($_SESSION['usuario_id'])) {
    echo json_encode([
        'exito'    => true,
        'logueado' => true,
        'usuario'  => [
            'id'     => $_SESSION['usuario_id'],
            'nombre' => $_SESSION['usuario_nombre'],
        ],
    ]);
} else {
    http_response_code(401);
    echo json_encode(['exito' => true, 'logueado' => false]);
}