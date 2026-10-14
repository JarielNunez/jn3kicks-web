<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="/jn3kicks-web/css/header-sesion.css">

<header class="header">
    <nav class="nav">
        <h2 class="logo">JN3 KICKS</h2>
        <ul class="nav__links">
            <li><a href="/jn3kicks-web/index.php">Inicio</a></li>
            <li><a href="/jn3kicks-web/catalogo.php">Catalogo</a></li>
            <li><a href="/jn3kicks-web/nosotros.php">Nosotros</a></li>
            <li><a href="/jn3kicks-web/carrito.php">Carrito</a></li>

            <li class="user-menu">
                <?php if (isset($_SESSION['usuario_nombre'])): ?>
                    <button id="btnUserIcon" class="user-icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                            <path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.3 0-9.8 1.6-9.8 4.9v2.5h19.6v-2.5c0-3.3-6.5-4.9-9.8-4.9z"/>
                        </svg>
                    </button>
                    <div id="userDropdown" class="user-dropdown">
                        <span class="dropdown-name">Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong></span>
                        <a href="/jn3kicks-web/php/login/logout.php" id="btnCerrarSesion" class="btn-logout-dropdown">Cerrar sesión</a>
                    </div>
                <?php else: ?>
                    <a href="/jn3kicks-web/login.php" class="user-icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                            <path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.3 0-9.8 1.6-9.8 4.9v2.5h19.6v-2.5c0-3.3-6.5-4.9-9.8-4.9z"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnIcon = document.getElementById('btnUserIcon');
    const dropdown = document.getElementById('userDropdown');

    if (btnIcon && dropdown) {
        btnIcon.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('active');
        });
        document.addEventListener('click', function() {
            dropdown.classList.remove('active');
        });
    }

    const btnLogout = document.getElementById('btnCerrarSesion');
    if (btnLogout) {
        btnLogout.addEventListener('click', function(e) {
            e.preventDefault();
            fetch('/jn3kicks-web/php/login/logout.php')
                .then(response => response.json())
                .then(data => {
                    if (data.exito) {
                        window.location.href = '/jn3kicks-web/index.php';
                    }
                })
                .catch(error => console.error('Error al cerrar sesión:', error));
        });
    }
});
</script>