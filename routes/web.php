<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Rutas públicas (sin autenticación)
|--------------------------------------------------------------------------
*/

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Páginas de autenticación (login y register)
// Estas rutas deberían estar disponibles solo para usuarios no autenticados, 
// por lo que debes verificar que el usuario no esté autenticado.
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'loginView'])->name('login');
    Route::get('/register', [LoginController::class, 'registerView'])->name('register');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [LoginController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren autenticación)
|--------------------------------------------------------------------------
*/

// Agrupar todas las rutas que requieren que el usuario esté autenticado
Route::middleware('auth')->group(function () {
    // Ruta para el dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Ruta para cerrar sesión
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Rutas de clientes (solo accesibles por 'admin' o 'contador')
    |--------------------------------------------------------------------------
    */
    Route::middleware([RoleMiddleware::class . ':admin,contador'])->group(function () {
        Route::resource('clients', ClientController::class);
    });
    
    /*
    |--------------------------------------------------------------------------
    | Rutas de usuarios (solo accesibles por 'admin')
    |--------------------------------------------------------------------------
    */
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Rutas adicionales según roles
    |--------------------------------------------------------------------------
    | Ejemplo de proveedores (solo admin puede gestionarlos en el futuro)
    | Route::middleware([RoleMiddleware::class . ':admin'])->resource('providers', ProviderController::class);
    */

    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::resource('providers', ProviderController::class);
    });

    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::resource('products', ProductController::class);
    });

    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
    });



    //Route::resource('providers', ProviderController::class);
    //Route::resource('products', ProductController::class);

    

});
