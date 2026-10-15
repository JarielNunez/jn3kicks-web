<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JN3 KICKS - @yield('titulo', 'Tienda de Tenis')</title>
    
    <link rel="stylesheet" href="{{ asset('css/header-sesion.css') }}">
    @stack('estilos')
</head>
<body>

    <header class="header">
        <nav class="nav">
            <h2 class="logo">JN3 KICKS</h2>
            <ul class="nav__links">
                <li><a href="/">Inicio</a></li>
                <li><a href="/catalogo">Catálogo</a></li>
                <li><a href="/nosotros">Nosotros</a></li>
                <li><a href="/carrito">Carrito</a></li>

                @auth
                    @if(auth()->user()?->esAdmin())
                        <li><a href="/admin/productos">Administrar</a></li>
                    @endif
                @endauth

                <li class="user-menu">
                    @auth
                        <button id="btnUserIcon" class="user-icon-btn" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                                <path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.3 0-9.8 1.6-9.8 4.9v2.5h19.6v-2.5c0-3.3-6.5-4.9-9.8-4.9z"/>
                            </svg>
                        </button>
                        <div id="userDropdown" class="user-dropdown">
                            <span class="dropdown-name">Hola, <strong>{{ auth()->user()->nombre }}</strong></span>
                            
                            <form action="/logout" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-logout-dropdown" style="background:none; border:none; cursor:pointer; width:100%; text-align:left; padding:0;">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="/login" class="user-icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                                <path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.3 0-9.8 1.6-9.8 4.9v2.5h19.6v-2.5c0-3.3-6.5-4.9-9.8-4.9z"/>
                            </svg>
                        </a>
                    @endauth
                </li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        @yield('contenido')
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} JN3 KICKS. Todos los derechos reservados.</p>
        <ul>
            <li><a href="#">Términos y Condiciones</a></li>
            <li><a href="#">Soporte</a></li>
            <li><a href="/contacto">Contacto</a></li>
        </ul>
    </footer>

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
    });
    </script>

    @stack('scripts')
</body>
</html>