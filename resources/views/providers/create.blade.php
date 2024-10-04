{{-- resources/views/providers/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Añadir Proveedor</h1>

    <form action="{{ route('providers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="nit">NIT</label>
            <input type="text" class="form-control" id="nit" name="nit" required>
        </div>
        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
