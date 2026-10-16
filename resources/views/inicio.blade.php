@extends('layouts.app')

@section('titulo', 'Inicio')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
@endpush

@section('contenido')
<main class="contenedor">

    @if ($principal)
        <section class="hero">
            <div class="hero__texto">
                <p class="hero__etiqueta">Nueva colección</p>
                <h1 class="hero__titulo">{{ $principal->nombre }}</h1>
                <p class="hero__descripcion">
                    Importados desde USA. Calidad garantizada.<br>
                    Compra con confianza.
                </p>
                <p class="hero__precio">RD$ {{ number_format((float) $principal->precio, 2) }}</p>
                <div class="hero__acciones">
                    <a href="{{ route('producto.show', $principal) }}" class="hero__boton">Ver producto</a>
                    <a href="{{ route('catalogo.index') }}" class="hero__boton hero__boton--secundario">Ver catálogo</a>
                </div>
            </div>

            <a href="{{ route('producto.show', $principal) }}" class="hero__imagen">
                <img src="{{ asset($principal->imagen) }}" alt="{{ $principal->nombre }}">
            </a>
        </section>
    @endif

    <section class="destacados">
        <h2 class="destacados__titulo">Destacados</h2>

        <div class="catalogo-productos">
            @foreach ($destacados as $producto)
                <article class="producto">
                    <a class="producto-imagen" href="{{ route('producto.show', $producto) }}">
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" loading="lazy">
                    </a>
                    <div class="producto-contenido">
                        <p class="producto-marca">{{ $producto->marca }}</p>
                        <h3>{{ $producto->nombre }}</h3>
                        <p class="producto-precio">RD$ {{ number_format((float) $producto->precio, 2) }}</p>
                        <a class="boton-detalle" href="{{ route('producto.show', $producto) }}">Ver producto</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

</main>
@endsection