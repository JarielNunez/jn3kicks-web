@extends('layouts.app')

@section('titulo', 'Find Your Account - JN3 KICKS')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/recuperar.css') }}">
@endpush

@section('contenido')
<div class="find-account-container">
    <h2>Recuperar Contraseña</h2>
    <p class="auth-subtitle">Ingresa tu correo electrónico asociado para buscar tu cuenta en JN3 KICKS.</p>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Mensaje de éxito --}}
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <form action="{{ route('password.search') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input 
                type="email" 
                name="correo" 
                id="correo" 
                placeholder="tucorreo@ejemplo.com" 
                value="{{ old('correo') }}" 
                required 
                autofocus
            >
        </div>

        <button type="submit" class="btn-search">Buscar Cuenta</button>
    </form>

    <div class="auth-footer flex-links">
        <a href="{{ url('/login') }}">Volver al Inicio de Sesión</a>
        <a href="{{ url('/registro') }}">¿No tienes cuenta? Regístrate</a>
    </div>
</div>
@endsection