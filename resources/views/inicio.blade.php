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

    <section class="beneficios">
    <div class="beneficio">
        <span class="beneficio__icono">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        </span>
        <div>
            <p class="beneficio__titulo">100% originales</p>
            <p class="beneficio__texto">Importados desde USA</p>
        </div>
    </div>
    <div class="beneficio">
        <span class="beneficio__icono">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        </span>
        <div>
            <p class="beneficio__titulo">Envío a todo RD</p>
            <p class="beneficio__texto">RD$250 a cualquier provincia</p>
        </div>
    </div>
    <div class="beneficio">
        <span class="beneficio__icono">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
        </span>
        <div>
            <p class="beneficio__titulo">Atención personalizada</p>
            <p class="beneficio__texto">Antes y después de tu compra</p>
        </div>
    </div>
</section>

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

    @if ($banner)
    <section class="hero hero--oscuro">
        <a href="{{ route('producto.show', $banner) }}" class="hero__imagen">
            <img src="{{ asset($banner->imagen) }}" alt="{{ $banner->nombre }}">
        </a>
        <div class="hero__texto">
            <p class="hero__etiqueta">Rendimiento</p>
            <h2 class="hero__titulo">Hechos para tu ritmo</h2>
            <p class="hero__descripcion">{{ $banner->nombre }}: comodidad y estilo para tu día a día.</p>
            <p class="hero__precio">RD$ {{ number_format((float) $banner->precio, 2) }}</p>
            <div class="hero__acciones">
                <a href="{{ route('producto.show', $banner) }}" class="hero__boton hero__boton--acento">Ver producto</a>
            </div>
        </div>
    </section>
@endif

</main>
@endsection