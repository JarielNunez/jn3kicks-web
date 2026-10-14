<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'JN3 KICKS')</title>
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    @stack('estilos')
</head>
<body>
    <header class="header">{{-- Robi: header compartido --}}</header>
    <main>@yield('contenido')</main>
    <footer class="footer">{{-- Robi: footer compartido --}}</footer>
    @stack('scripts')
</body>
</html>

