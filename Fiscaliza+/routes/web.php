<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\HomeController;

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rota protegida de denúncia
Route::post('/denuncia', [DenunciaController::class, 'store'])->middleware('auth')->name('denuncia.store');

Route::get('/denuncia/criar', [DenunciaController::class, 'create'])->name('denuncia.create');
Route::get('/', function () {
    return view('index');
});
Route::get('/cadastrar-denuncia', function () {
    return view('cadastrar-denuncia');
});
Route::get('/acompanhar-denuncia', function () {
    return view('acompanhar-denuncia');
});
Route::get('/perfil', function () {
    return view('perfil');
});






