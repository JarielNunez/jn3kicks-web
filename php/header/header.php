<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<<<<<<< HEAD
<link rel="stylesheet" href="header.css">

<header class="site-header">
    <nav class="nav">
        <a href="index.html" class="nav-brand">Mi Tienda</a>

        <div class="user-area">
            <?php if (isset($_SESSION['usuario_nombre'])): ?>
                <span class="user-welcome">
                    Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong>
                </span>
                <a href="logout.php" class="btn btn-logout">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.html" class="btn btn-ghost">Iniciar sesión</a>
                <a href="registro.html" class="btn btn-primary">Registrarse</a>
            <?php endif; ?>
        </div>
=======
<link rel="stylesheet" href="../../css/header-sesion.css">

<header class="header">
    <nav class="nav">
        <h2 class="logo">JN3 KICKS</h2>
        <ul class="nav__links">
            <li><a href="../../index.php">Inicio</a></li>
            <li><a href="../../catalogo.php">Catalogo</a></li>
            <li><a href="../../nosotros.php">Nosotros</a></li>
            <li><a href="../../carrito.php">Carrito</a></li>

            <?php if (isset($_SESSION['usuario_nombre'])): ?>
                <li class="nav__usuario">Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong></li>
                <li><a href="../login/logout.php" class="btn-logout">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="../../login.php">Login</a></li>
            <?php endif; ?>
        </ul>
>>>>>>> 8403eef9bc76565d59499e989806c9623c76588b
    </nav>
</header>