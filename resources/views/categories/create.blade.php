{{-- resources/views/categories/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Añadir Categoría</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="parent_id">Categoría Principal (opcional)</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Sin categoría principal</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
