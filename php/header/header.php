<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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
    </nav>
</header>