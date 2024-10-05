@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Añadir Producto</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del producto</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="category_id">Categoría</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @foreach($category->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">&nbsp;&nbsp;{{ $subcategory->name }}</option>
                    @endforeach
                @endforeach
            </select>
            <a href="{{ route('categories.create') }}" class="btn btn-secondary mt-3">+ Categoria</a>
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
