{{-- resources/views/user/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cliente</h1>

    <form action="{{ route('users.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
        </div>
        <div class="form-group">
            <label for="lastname">Apellido</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $client->lastname }}" required>
        <div class="form-group">
            <label for="nit">NIT</label>
            <input type="text" class="form-control" id="nit" name="nit" value="{{ $client->nit }}" required>
        </div>
        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $client->address }}">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $client->phone }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
