{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Bienvenido a Nuestra Aplicación')

@section('content')
<div class="container text-center mt-5">
    <h1>Bienvenido a Nuestra Aplicación</h1>
    <p class="lead">Explora nuestros servicios y descubre cómo podemos ayudarte a gestionar tus necesidades contables, fiscales y más.</p>

    <p class="mt-4">
        <a href="{{ route('login') }}" class="btn btn-primary me-2">Iniciar Sesión</a>
        <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
    </p>

    <!-- Sección de información -->
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">¿Quiénes Somos?</h5>
                    <p class="card-text">Somos una empresa dedicada a ofrecer servicios contables y financieros para ayudar a tu negocio a crecer.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nuestros Servicios</h5>
                    <p class="card-text">Ofrecemos asesoría fiscal, financiera y contable para garantizar el éxito de tu empresa.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Contacto</h5>
                    <p class="card-text">¿Tienes alguna duda? No dudes en contactarnos para recibir más información sobre nuestros servicios.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5">
        <p class="text-muted">&copy; 2024 - Nuestra Aplicación. Todos los derechos reservados.</p>
    </footer>
</div>
@endsection
