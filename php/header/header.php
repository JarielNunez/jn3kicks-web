<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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
    </nav>
</header>