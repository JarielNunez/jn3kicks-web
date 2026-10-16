@extends('layouts.app')

@section('titulo', 'Administrar Productos')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('contenido')
<div class="admin">

    <div class="admin__encabezado">
        <h1 class="admin__titulo">Administrar Productos</h1>
        <p class="admin__subtitulo">Agrega, edita o elimina productos del catálogo</p>
        <a href="{{ route('admin.productos.create') }}" class="boton boton--primario">Agregar producto</a>
    </div>

    @if (session('exito'))
        <p class="admin__mensaje admin__mensaje--exito">{{ session('exito') }}</p>
    @endif
    @if (session('error'))
        <p class="admin__mensaje admin__mensaje--error">{{ session('error') }}</p>
    @endif

    <section class="admin__tabla-wrapper">
        <h2 class="admin__form-titulo">Productos existentes</h2>

        <table class="admin__tabla">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Género</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $p)
                    <tr>
                        <td><img class="admin__tabla-imagen" src="{{ asset($p->imagen) }}" alt="{{ $p->nombre }}"></td>
                        <td>{{ $p->nombre }}</td>
                        <td>RD$ {{ number_format($p->precio, 2) }}</td>
                        <td>{{ ucfirst($p->marca) }}</td>
                        <td>{{ ucfirst($p->genero) }}</td>
                        <td>{{ ucfirst($p->categoria) }}</td>
                        <td>{{ $p->stock }}</td>
                        <td>
                            <div class="admin__tabla-acciones">
                                <a href="{{ route('admin.productos.edit', $p) }}" class="admin__boton-accion admin__boton-editar">Editar</a>

                                <form action="{{ route('admin.productos.destroy', $p) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin__boton-accion admin__boton-eliminar">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

</div>
@endsection