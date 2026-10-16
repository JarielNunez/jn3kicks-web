@extends('layouts.app')

@section('titulo', 'Carrito de Compras - JN3 Kicks')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
@endpush

@section('contenido')
<main class="carrito-pagina">
    <h1 class="carrito-pagina__titulo">Tu Carrito de Compras</h1>

    <div class="carrito-pagina__contenedor">
        <div class="carrito-pagina__lista">
            @forelse ($articulos as $articulo)
<div class="carrito-item"
     data-carrito-id="{{ $articulo->id }}"
     data-precio="{{ $articulo->producto->precio }}">
    <div class="carrito-item__imagen">
        <img class="carrito-item__foto"
             src="{{ asset($articulo->producto->imagen) }}"
             alt="{{ $articulo->producto->nombre }}">
    </div>
    <div class="carrito-item__info">
        <span class="carrito-item__nombre">{{ $articulo->producto->nombre }}</span>
        <span class="carrito-item__precio">RD${{ number_format($articulo->producto->precio, 2) }}</span>
    </div>
    <div class="carrito-item__controles">
        <button type="button" class="carrito-item__btn">&lt;</button>
        <span class="carrito-item__cantidad">{{ $articulo->cantidad }}</span>
        <button type="button" class="carrito-item__btn">&gt;</button>
    </div>
    <a href="#" class="carrito-item__eliminar">Eliminar</a>
</div>            @empty
                <p class="carrito-pagina__vacio">Tu carrito está vacío.</p>
            @endforelse
        </div>

        <div class="carrito-resumen">
            <h2 class="carrito-resumen__titulo">Resumen de la Orden</h2>

            <div class="carrito-resumen__fila">
                <span>Subtotal:</span>
                <span class="carrito-resumen__valor-subtotal">RD$0</span>
            </div>
            <div class="carrito-resumen__fila">
                <span>Envío:</span>
                <span class="carrito-resumen__valor-envio">RD$0</span>
            </div>
            <div class="carrito-resumen__fila carrito-resumen__fila--total">
                <span>Total:</span>
                <span class="carrito-resumen__valor-total">RD$0</span>
            </div>

            @auth
                <button type="button" class="carrito-resumen__boton">Proceder al Pago</button>
            @else
                <button type="button" class="carrito-resumen__boton"
                        onclick="window.location.href='{{ url('/login') }}'">
                    Proceder al Pago
                </button>
            @endauth
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('js/carrito.js') }}"></script>
@endpush