@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">


@section('titulo', 'Iniciar Sesión - JN3 KICKS')

@section('contenido')
<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <p class="auth-subtitle">Ingresa tus datos para acceder a tu cuenta de JN3 KICKS</p>

    {{-- Mostrar errores de validación o credenciales --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input type="email" name="correo" id="correo" placeholder="tucorreo@ejemplo.com" value="{{ old('correo') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-login">Ingresar</button>
    </form>

    <div class="auth-footer flex-links">
        <a href="{{ url('/registro') }}">¿No tienes cuenta? Regístrate</a>
        <a href="{{ url('/recuperar-contrasena') }}">¿Olvidaste tu contraseña?</a>
    </div>
</div>
@endsection