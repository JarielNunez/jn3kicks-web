<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo de productos | JN3 KICKS</title>

    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}?v=2">
    <script src="{{ asset('js/catalogo.js') }}" defer></script>
</head>

<body>

    <header class="catalogo-header">
        <a href="{{ route('catalogo.index') }}" class="marca-logo">
            JN3 KICKS
        </a>

        <nav>
            <a href="{{ route('catalogo.index') }}">Catálogo</a>
        </nav>
    </header>

    <main class="contenedor">

        <section class="introduccion">
            <p class="etiqueta">JN3 KICKS</p>
            <h1>Nuestra colección</h1>
            <p>Descubre los tenis ideales para tu estilo.</p>
        </section>

        <!-- Buscador y filtros -->
        <section class="herramientas">

            <div class="campo-busqueda">
                <label for="buscar">Buscar productos</label>
                <input
                    type="search"
                    id="buscar"
                    placeholder="Escribe el nombre de un producto..."
                    autocomplete="off"
                >
            </div>

            <div class="campo-filtro">
                <label for="filtro-marca">Marca</label>
                <select id="filtro-marca">
                    <option value="">Todas las marcas</option>
                    @foreach ($productos->pluck('marca')->filter()->unique()->sort() as $marca)
                        <option value="{{ $marca }}">{{ $marca }}</option>
                    @endforeach
                </select>
            </div>

            <div class="campo-filtro">
                <label for="filtro-genero">Género</label>
                <select id="filtro-genero">
                    <option value="">Todos los géneros</option>
                    @foreach ($productos->pluck('genero')->filter()->unique()->sort() as $genero)
                        <option value="{{ $genero }}">{{ $genero }}</option>
                    @endforeach
                </select>
            </div>

            <div class="campo-filtro">
                <label for="filtro-categoria">Categoría</label>
                <select id="filtro-categoria">
                    <option value="">Todas las categorías</option>
                    @foreach ($productos->pluck('categoria')->filter()->unique()->sort() as $categoria)
                        <option value="{{ $categoria }}">{{ $categoria }}</option>
                    @endforeach
                </select>
            </div>

            <div class="campo-filtro">
                <label for="orden">Ordenar por</label>
                <select id="orden">
                    <option value="destacados">Orden original</option>
                    <option value="precio-menor">Precio: menor a mayor</option>
                    <option value="precio-mayor">Precio: mayor a menor</option>
                    <option value="nombre">Nombre: A-Z</option>
                </select>
            </div>

        </section>
        <!-- FIN DEL PANEL DE FILTROS -->

        <!-- Tarjetas de productos -->
        <section class="catalogo-productos" id="lista-productos">

            @forelse ($productos as $producto)

                <article
                    class="producto"
                    data-nombre="{{ $producto->nombre }}"
                    data-marca="{{ $producto->marca }}"
                    data-genero="{{ $producto->genero }}"
                    data-categoria="{{ $producto->categoria }}"
                    data-precio="{{ $producto->precio }}"
                >

                    <a
                        class="producto-imagen"
                        href="{{ route('producto.show', $producto) }}"
                        aria-label="Ver {{ $producto->nombre }}"
                    >
                        @if ($producto->imagen)
                            <img
                                src="{{ asset($producto->imagen) }}"
                                alt="{{ $producto->nombre }}"
                                loading="lazy"
                            >
                        @else
                            <div class="sin-imagen">
                                Imagen no disponible
                            </div>
                        @endif
                    </a>

                    <div class="producto-contenido">

                        <p class="producto-marca">
                            {{ $producto->marca ?: 'JN3 KICKS' }}
                        </p>

                        <h2>{{ $producto->nombre }}</h2>

                        <p class="producto-categoria">
                            {{ $producto->categoria ?: 'Calzado' }}
                        </p>

                        <p class="producto-precio">
                            RD$ {{ number_format((float) $producto->precio, 2) }}
                        </p>

                        <a
                            class="boton-detalle"
                            href="{{ route('producto.show', $producto) }}"
                        >
                            Ver detalles
                        </a>

                    </div>

                </article>

            @empty

                <p class="mensaje-vacio">
                    No hay productos registrados en el catálogo.
                </p>

            @endforelse

        </section>

        <p id="sin-resultados" class="mensaje-vacio" hidden>
            No se encontraron productos con esos criterios.
        </p>

    </main>

    <footer class="catalogo-footer">
        <p>
            &copy; {{ date('Y') }} JN3 KICKS.
            Todos los derechos reservados.
        </p>
    </footer>

</body>
</html>