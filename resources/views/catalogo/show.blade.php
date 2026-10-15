<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $producto->nombre }} | JN3 KICKS</title>

    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
</head>

<body>

    <header class="catalogo-header">
        <a href="{{ route('catalogo.index') }}" class="marca-logo">
            JN3 KICKS
        </a>

        <nav>
            <a href="{{ route('catalogo.index') }}">
                Volver al catálogo
            </a>
        </nav>
    </header>

    <main class="contenedor">

        <p class="ruta-navegacion">
            <a href="{{ route('catalogo.index') }}">Catálogo</a>
            / {{ $producto->nombre }}
        </p>

        <section class="detalle-producto">

            <div class="detalle-imagen">
                @if ($producto->imagen)
                    <img
                        src="{{ asset($producto->imagen) }}"
                        alt="{{ $producto->nombre }}"
                    >
                @else
                    <div class="sin-imagen">
                        Imagen no disponible
                    </div>
                @endif
            </div>

            <div class="detalle-informacion">

                <p class="producto-marca">
                    {{ $producto->marca ?: 'JN3 KICKS' }}
                </p>

                <h1>{{ $producto->nombre }}</h1>

                <p class="detalle-precio">
                    RD$ {{ number_format((float) $producto->precio, 2) }}
                </p>

                <p>
                    <strong>Categoría:</strong>
                    {{ $producto->categoria ?: 'No especificada' }}
                </p>

                <p>
                    <strong>Género:</strong>
                    {{ $producto->genero ?: 'No especificado' }}
                </p>

                <p>
                    <strong>Disponibilidad:</strong>

                    @if ((int) $producto->stock > 0)
                        <span class="disponible">Disponible</span>
                    @else
                        <span class="agotado">Agotado</span>
                    @endif
                </p>

                <p>
                    <strong>Unidades disponibles:</strong>
                    {{ max(0, (int) $producto->stock) }}
                </p>

                <a
                    href="{{ route('catalogo.index') }}"
                    class="boton-detalle"
                >
                    Regresar al catálogo
                </a>

            </div>

        </section>

    </main>

    <footer class="catalogo-footer">
        <p>
            &copy; {{ date('Y') }} JN3 KICKS.
            Todos los derechos reservados.
        </p>
    </footer>

</body>
</html>
