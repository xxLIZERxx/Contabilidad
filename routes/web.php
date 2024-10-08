<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

/*
|---------------------------------------------------------------------------
| Rutas públicas (sin autenticación)
|---------------------------------------------------------------------------
*/

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación para usuarios no autenticados (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'loginView'])->name('login');
    Route::get('/register', [LoginController::class, 'registerView'])->name('register');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [LoginController::class, 'register']);
});

/*
|---------------------------------------------------------------------------
| Rutas protegidas (requieren autenticación)
|---------------------------------------------------------------------------
*/

// Agrupar todas las rutas protegidas que requieren que el usuario esté autenticado
Route::middleware('auth')->group(function () {

    // Ruta para el dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Ruta para cerrar sesión
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |---------------------------------------------------------------------------
    | Rutas protegidas por rol de usuario (admin o contador)
    |---------------------------------------------------------------------------
    */

    // Rutas de clientes (solo accesibles por admin o contador)
    Route::middleware([RoleMiddleware::class . ':admin,contador'])->group(function () {
        Route::resource('clients', ClientController::class);
    });

    // Rutas de facturas (solo accesibles por admin o contador)
    Route::middleware([RoleMiddleware::class . ':admin,contador'])->group(function () {
        Route::resource('invoices', InvoiceController::class);
        Route::get('/invoices/{id}/pdf', [InvoiceController::class, 'downloadPDF'])->name('invoices.pdf');
    });

    /*
    |---------------------------------------------------------------------------
    | Rutas exclusivas para admin
    |---------------------------------------------------------------------------
    */

    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('providers', ProviderController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
    });


    Route::get('/reporte-ventas', [InvoiceController::class, 'salesReport'])->name('sales.report');
    Route::get('/reporte-ventas/pdf', [InvoiceController::class, 'salesReportPDF'])->name('sales.report.pdf');
    Route::get('/sales-report/pdf', [InvoiceController::class, 'salesReportPDF'])->name('sales.report.pdf');


});
