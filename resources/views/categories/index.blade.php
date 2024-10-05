{{-- resources/views/categories/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Categorías</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Añadir Categoría</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Subcategorías</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    @if($category->subcategories->isEmpty())
                        <em>No tiene subcategorías</em>
                    @else
                        <ul>
                            @foreach($category->subcategories as $subcategory)
                                <li>{{ $subcategory->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
