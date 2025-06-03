<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\HomeController;

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

// Rotas protegidas (precisam de autenticação)
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/denuncia', [DenunciaController::class, 'store'])->name('denuncia.store');
});

// Rotas das páginas
Route::get('/cadastrar-denuncia', function () {
    return view('cadastrar-denuncia');
})->name('cadastrar-denuncia');

Route::get('/acompanhar-denuncia', function () {
    return view('acompanhar-denuncia');
})->name('acompanhar-denuncia');

Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil');

Route::get('/visualiza-denuncia', function () {
    return view('visualiza-denuncia');
})->name('visualiza-denuncia');

Route::get('/recuperar', function () {
    return view('recuperar');
})->name('recuperar');

Route::get('/perfil-adm', function () {
    return view('perfil-adm');
})->name('perfil-adm');

Route::get('/mudar-senha-adm', function () {
    return view('mudar-senha-adm');
})->name('mudar-senha-adm');

Route::get('/gerir-denuncias-adm', function () {
    return view('gerir-denuncias-adm');
})->name('gerir-denuncias-adm');

Route::get('/feedback-orgao', function () {
    return view('feedback-orgao');
})->name('feedback-orgao');

Route::get('/feedback-orgao-adm', function () {
    return view('feedback-orgao-adm');
})->name('feedback-orgao-adm');

Route::get('/enviar-mensagem-adm', function () {
    return view('enviar-mensagem-adm');
})->name('enviar-mensagem-adm');

Route::get('/visualizar-denuncia-adm', function () {
    return view('visualizar-denuncia-ADM');
})->name('visualizar-denuncia-adm');

Route::get('/avaliacao-orgao', function () {
    return view('avaliacao-orgao');
})->name('avaliacao-orgao');

Route::get('/avaliacao-orgao-adm', function () {
    return view('avaliacao-orgao-adm');
})->name('avaliacao-orgao-adm');

Route::get('/apoiar-denuncia', function () {
    return view('apoiar-denuncia');
})->name('apoiar-denuncia');

Route::get('/alterar-perfil-usuario', function () {
    return view('alterar-perfil-usuario');
})->name('alterar-perfil-usuario');

Route::get('/alter-perfil-adm', function () {
    return view('alter-perfil-adm');
})->name('alter-perfil-adm');






