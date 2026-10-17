@extends('layouts.app')

@section('titulo', 'Agregar producto')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('contenido')
<div class="admin">

    <div class="admin__encabezado">
        <h1 class="admin__titulo">Agregar producto nuevo</h1>
    </div>

    <section class="admin__formulario-wrapper">
        <form action="{{ route('admin.productos.store') }}" method="POST" class="admin__form">
            @csrf

            @include('admin.productos._form')

            <div class="admin__form-botones">
                <button type="submit" class="boton boton--primario">Agregar producto</button>
                <a href="{{ route('admin.productos.index') }}" class="boton boton--secundario">Cancelar</a>
            </div>
        </form>
    </section>

</div>
@endsection