<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mostrar lista de usuarios
    public function index() {
        $users = User::all();
        return view('users.index', compact('users')); 
    }

    // Crear nuevo usuario
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,contador,cliente',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('users.index');
    }

    // Mostrar detalles de un usuario
    public function show(User $user) {
        return view('users.show', compact('user'));
    }

    // Mostrar el formulario de edición del rol de un usuario
    public function edit(User $user) {
        // Cargar la vista de edición, pasando los datos del usuario
        return view('users.edit', compact('user'));
    }

    // Actualizar solo el rol de un usuario
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|string|in:admin,contador,cliente',
            'status' => 'required|boolean', // Validar el campo status
        ]);
    
        $user->update([
            'role' => $validated['role'],
            'status' => $validated['status'], // Actualizar el estado
        ]);
    
        return redirect()->route('users.index')->with('success', 'Rol y estado actualizados exitosamente.');
    }
    
}
