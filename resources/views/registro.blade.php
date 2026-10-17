@extends('layouts.app')

@section('titulo', 'Registro - JN3 KICKS')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
@endpush

@section('contenido')
<div class="register-container">
    <h2>Crea tu cuenta</h2>
    <p class="auth-subtitle">Completa tus datos para registrarte en JN3 KICKS</p>

    {{-- Mostrar lista de errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/registro') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" value="{{ old('nombre') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input type="email" name="correo" id="correo" placeholder="tucorreo@ejemplo.com" value="{{ old('correo') }}" required>
        </div>

        <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" placeholder="••••••••" required>
            <p class="form-hint">Mínimo 6 caracteres.</p>
        </div>

        <div class="form-group">
            <label for="contrasena_confirmation">Confirmar Contraseña</label>
            <input type="password" name="contrasena_confirmation" id="contrasena_confirmation" placeholder="••••••••" required>
        </div>

        <div class="checkbox-container">
            <input type="checkbox" name="terminos" id="terminos" value="1" required>
            <label for="terminos">
                Acepto los <a href="#">Términos y Condiciones</a> y la <a href="#">Política de Privacidad</a>
            </label>
        </div>

        <button type="submit" class="btn-register">Crear Cuenta</button>
    </form>

    <div class="auth-footer">
        ¿Ya tienes una cuenta? <a href="{{ url('/login') }}">Inicia sesión</a>
    </div>
</div>
@endsection