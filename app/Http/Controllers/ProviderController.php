<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    // Método para listar todos los proveedores
    public function index() {
        $providers = Provider::all();
        return view('providers.index', compact('providers'));
    }

    // Mostrar el formulario para crear un nuevo proveedor
    public function create() {
        return view('providers.create');
    }

    // Almacenar un nuevo proveedor en la base de datos
    public function store(Request $request) {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nit' => 'required|string|max:50|unique:providers,nit',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        // Crear un nuevo proveedor con los datos validados
        Provider::create($validated);

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('providers.index')->with('success', 'Proveedor añadido exitosamente.');
    }

    // Mostrar los detalles de un proveedor
    public function show(Provider $provider) {
        return view('providers.show', compact('provider'));
    }

    // Mostrar el formulario para editar un proveedor existente
    public function edit(Provider $provider) {
        return view('providers.edit', compact('provider'));
    }

    // Actualizar un proveedor existente en la base de datos
    public function update(Request $request, Provider $provider) {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nit' => 'required|string|max:50|unique:providers,nit,' . $provider->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        // Actualizar el proveedor con los datos validados
        $provider->update($validated);

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('providers.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    // Eliminar un proveedor de la base de datos
    public function destroy(Provider $provider) {
        // Eliminar el proveedor
        $provider->delete();

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('providers.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
