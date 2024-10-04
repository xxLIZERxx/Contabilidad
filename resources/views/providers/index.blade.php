{{-- resources/views/providers/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Proveedores</h1>
    <a href="{{ route('providers.create') }}" class="btn btn-primary mb-3">Añadir Proveedor</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>NIT</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($providers as $provider)
            <tr>
                <td>{{ $provider->name }}</td>
                <td>{{ $provider->nit }}</td>
                <td>{{ $provider->address }}</td>
                <td>{{ $provider->phone }}</td>
                <td>{{ $provider->email }}</td>
                <td>
                    <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('providers.edit', $provider->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('providers.destroy', $provider->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Inicio</a>
    <style>
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</div>
@endsection
