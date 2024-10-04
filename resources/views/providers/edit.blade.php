{{-- resources/views/providers/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Proveedor</h1>

    <form action="{{ route('providers.update', $provider->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $provider->name }}" required>
        </div>
        <div class="form-group">
            <label for="nit">NIT</label>
            <input type="text" class="form-control" id="nit" name="nit" value="{{ $provider->nit }}" required>
        </div>
        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $provider->address }}">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $provider->phone }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $provider->email }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
