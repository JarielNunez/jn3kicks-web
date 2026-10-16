@extends('layouts.app')

@section('titulo', $producto->nombre . ' | JN3 KICKS')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
@endpush

@section('contenido')
<main class="contenedor">

    <p class="ruta-navegacion">
        <a href="{{ route('catalogo.index') }}">Catálogo</a>
        / {{ $producto->nombre }}
    </p>

    <section class="detalle-producto">

        <div class="detalle-imagen">
            @if ($producto->imagen)
                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
            @else
                <div class="sin-imagen">Imagen no disponible</div>
            @endif
        </div>

        <div class="detalle-informacion">

            <p class="producto-marca">{{ $producto->marca ?: 'JN3 KICKS' }}</p>

            <h1>{{ $producto->nombre }}</h1>

            <p class="detalle-precio">RD$ {{ number_format((float) $producto->precio, 2) }}</p>

            <p><strong>Categoría:</strong> {{ $producto->categoria ?: 'No especificada' }}</p>
            <p><strong>Género:</strong> {{ $producto->genero ?: 'No especificado' }}</p>

            <p>
                <strong>Disponibilidad:</strong>
                @if ((int) $producto->stock > 0)
                    <span class="disponible">Disponible</span>
                @else
                    <span class="agotado">Agotado</span>
                @endif
            </p>

            <p><strong>Unidades disponibles:</strong> {{ max(0, (int) $producto->stock) }}</p>

            @if ((int) $producto->stock > 0)
                <form action="{{ route('carrito.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    <button type="submit" class="boton-detalle">Agregar al carrito</button>
                </form>
            @endif

            <a href="{{ route('catalogo.index') }}" class="boton-detalle">Regresar al catálogo</a>

        </div>

    </section>

</main>
@endsection