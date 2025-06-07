<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// Rota principal
Route::get('/', function () {
    return view('index');
})->name('index');

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('cadastro');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('termos', function() {
    return view(('terms'));
})->name('termos');
// Rotas protegidas (precisam de autenticação)
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/denuncia', [DenunciaController::class, 'store'])->name('denuncia.store');
});

// Rotas das páginas
Route::get('/cadastrar-denuncia', function () {
    return view('denuncias.cadastrar-denuncia');
})->name('denuncias.cadastrar-denuncia');

Route::post('/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');

Route::get('/acompanhar-denuncia', function () {
    return view('acompanhar-denuncia');
})->name('acompanhar-denuncia');

Route::get('/perfil', [ProfileController::class, 'page'])
    ->name('profile.perfil')
    ->middleware('auth');
Route::put('perfil/{id}/update', [ProfileController::class, 'update'])->name('usuario.update');




