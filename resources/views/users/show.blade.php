{{-- resources/views/User/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Usuario</h1>
    
    <div class="card">
        <div class="card-header">
            Información del Usuario
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>

    <a href="{{ route('user.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
