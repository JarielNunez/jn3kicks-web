@extends('layouts.app')

@section('titulo', 'Nosotros')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nosotros.css') }}">
@endpush

@section('contenido')
<main class="contenedor">

    <section class="introduccion">
        <p class="etiqueta">JN3 KICKS</p>
        <h1>Sobre nosotros</h1>
        <p>Tenis originales importados desde USA. Calidad garantizada, compra con confianza.</p>
    </section>

    <div class="about">

        <p class="about__text">
            JN3 KICKS nació en San Francisco de Macorís con una idea simple: que conseguir tenis originales
            en República Dominicana no tenga que ser complicado ni riesgoso.
        </p>


        <section class="about__mapa">
            <h2 class="about__title">¿Dónde estamos?</h2>
            <iframe
                src="https://www.google.com/maps?q=San+Francisco+de+Macoris&output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Ubicación de JN3 KICKS"
                allowfullscreen>
            </iframe>
        </section>

        <section class="about__purpose">
            <div class="about__mission">
                <h2 class="about__subtitle">Misión</h2>
                <p class="about__text">Ofrecer tenis 100% originales a precios justos, con atención cercana y envío a todo el país.</p>
            </div>
            <div class="about__vision">
                <h2 class="about__subtitle">Visión</h2>
                <p class="about__text">Ser la tienda de referencia en RD para quienes buscan rendimiento y estilo con garantía de autenticidad.</p>
            </div>
        </section>

        <section class="about__values">
            <h2 class="about__title">Nuestros valores</h2>
            <div class="about__value-list">
                <div class="about__value">
                    <div class="about__value-icon">✓</div>
                    <h3 class="about__value-title">Autenticidad</h3>
                    <p class="about__value-text">Solo vendemos producto original.</p>
                </div>
                <div class="about__value">
                    <div class="about__value-icon">★</div>
                    <h3 class="about__value-title">Calidad</h3>
                    <p class="about__value-text">Cada par se revisa antes de enviarse.</p>
                </div>
                <div class="about__value">
                    <div class="about__value-icon">♥</div>
                    <h3 class="about__value-title">Confianza</h3>
                    <p class="about__value-text">Atención directa antes y después de tu compra.</p>
                </div>
            </div>
        </section>

    </div>

</main>
@endsection