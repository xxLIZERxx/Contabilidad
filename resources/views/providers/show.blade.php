{{-- resources/views/clients/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Cliente</h1>
    
    <div class="card">
        <div class="card-header">
            Información del Cliente
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $client->name }}</p>
            <p><strong>Apellido:</strong> {{ $client->lastname }}</p>
            <p><strong>NIT:</strong> {{ $client->nit }}</p>
            <p><strong>Dirección:</strong> {{ $client->address }}</p>
            <p><strong>Teléfono:</strong> {{ $client->phone }}</p>
            <p><strong>Email:</strong> {{ $client->email }}</p>
        </div>
    </div>

    <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
