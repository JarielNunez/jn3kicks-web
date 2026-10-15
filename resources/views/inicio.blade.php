@extends('layouts.app')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('titulo', 'Inicio')

@section('contenido')
<div class="container">
    <h1>Bienvenidos a JN3 KICKS</h1>
    <p>Los mejores tenis al mejor precio.</p>

    <h2>Productos Destacados</h2>
    <div class="productos-grid">
        @foreach($destacados as $producto)
            <div class="producto-card">
                <img src="{{ asset('img/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" style="max-width: 200px; width: 100%; height: auto;">
                <h3>{{ $producto->nombre }}</h3>
                <p>RD$ {{ number_format($producto->precio, 2) }}</p>
                <a href="/producto/{{ $producto->id }}" class="btn">Ver producto</a>
            </div>
        @endforeach
    </div>
</div>
@endsection