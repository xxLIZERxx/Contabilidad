{{-- resources/views/providers/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Proveedor</h1>
    
    <div class="card">
        <div class="card-header">
            Información del Proveedor
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $provider->name }}</p>
            <p><strong>NIT:</strong> {{ $provider->nit }}</p>
            <p><strong>Dirección:</strong> {{ $provider->address }}</p>
            <p><strong>Teléfono:</strong> {{ $provider->phone }}</p>
            <p><strong>Email:</strong> {{ $provider->email }}</p>
        </div>
    </div>

    <a href="{{ route('providers.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
