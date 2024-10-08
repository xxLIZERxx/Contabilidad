{{-- resources/views/user/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Rol de Usuario</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="role">Rol</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="contador" {{ $user->role == 'contador' ? 'selected' : '' }}>Contador</option>
                <option value="cliente" {{ $user->role == 'cliente' ? 'selected' : '' }}>Cliente</option>
                <!-- Agrega más roles según tus necesidades -->
            </select>
        </div>
        <div class="form-group">
            <label for="status">Estado</label>
            <select class="form-control" id="status" name="status" required>
                <option value="1" {{ $user->status ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$user->status ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        

        <button type="submit" class="btn btn-success">Actualizar Rol</button>
    </form>
</div>
@endsection
