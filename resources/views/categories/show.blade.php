{{-- resources/views/categories/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Categoría</h1>

    <div class="card">
        <div class="card-header">
            Información de la Categoría
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $category->name }}</p>
            <p><strong>Categoría Principal:</strong> 
                {{ $category->parent ? $category->parent->name : 'Sin categoría principal' }}
            </p>
            <p><strong>Subcategorías:</strong></p>
            @if($category->subcategories->isEmpty())
                <em>No tiene subcategorías</em>
            @else
                <ul>
                    @foreach($category->subcategories as $subcategory)
                        <li>{{ $subcategory->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
@endsection
