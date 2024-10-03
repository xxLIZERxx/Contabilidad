{{-- resources/views/clients/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Clientes</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Añadir Cliente</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>NIT</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->lastname }}</td>
                <td>{{ $client->nit }}</td>
                <td>{{ $client->address }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
                <td>
                    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
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
