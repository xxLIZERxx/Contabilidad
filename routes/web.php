<?php

use App\Http\Controllers\LoginController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'loginView'])->middleware(middleware: AuthMiddleware::class);
Route::get('/register', [LoginController::class, 'registerView'])->middleware(middleware: AuthMiddleware::class);
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware(middleware: AuthMiddleware::class);
Route::post('/register', [LoginController::class, 'register'])->name('register')->middleware(middleware: AuthMiddleware::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(middleware: AuthMiddleware::class);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(middleware: AuthMiddleware::class);
