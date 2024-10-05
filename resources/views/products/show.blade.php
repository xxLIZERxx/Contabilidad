{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Producto o Servicio</h1>
    
    <div class="card">
        <div class="card-header">
            Información del Producto
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $product->name }}</p>
            <p><strong>Categoría:</strong> {{ $product->category->name ?? 'Sin categoría' }}</p>
            <p><strong>Precio:</strong> Q. {{ $product->price }}</p>
            <p><strong>Descripción:</strong> {{ $product->description ?? 'Sin descripción' }}</p>
        </div>
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
