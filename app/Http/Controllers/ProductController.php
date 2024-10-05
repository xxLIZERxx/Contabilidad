<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $products = Product::all(); // Obtener todos los productos
        return view('products.index', compact('products'));
    }

    // Mostrar formulario para crear un nuevo producto
    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('subcategories')->get();
        return view('products.create', compact('categories'));
    }

    // Almacenar un nuevo producto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Asegúrate de que se elige una categoría válida
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    // Mostrar un producto específico
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Mostrar formulario para editar un producto existente
    public function edit(Product $product)
    {
        $categories = Category::whereNull('parent_id')->with('subcategories')->get(); // Necesitas las categorías para editar
        return view('products.edit', compact('product', 'categories'));
    }

    // Actualizar un producto existente en la base de datos
    public function update(Request $request, Product $product)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Usar category_id en lugar de category
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Actualizar el producto
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    // Eliminar un producto de la base de datos
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito.');
    }
}
