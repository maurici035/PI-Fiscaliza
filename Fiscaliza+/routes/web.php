<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComentariosDenunciasController;
use App\Http\Controllers\CurtidasDenunciasController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\EmpresaAuthController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// Rota principal
Route::get('/', function () {
    return view('index');
})->name('index');

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Login de empresas
Route::get('/login-empresa', [EmpresaAuthController::class, 'showLoginForm'])->name('empresa.login');
Route::post('/login-empresa', [EmpresaAuthController::class, 'login'])->name('empresa.login.post');

Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('cadastro');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cadastro/empresa', [EmpresaController::class, 'create'])->name('empresa.cadastro');
Route::post('/cadastro/empresa', [EmpresaController::class, 'store'])->name('empresa.store');

Route::get('/empresa/dashboard', [EmpresaController::class, 'page'])->name('empresa.dashboard');


Route::patch('/denuncias/{id}/concluir', [DenunciaController::class, 'concluir'])->name('denuncias.concluir');
Route::patch('/denuncias/{id}/desconcluir', [DenunciaController::class, 'desconcluir'])->name('denuncias.desconcluir');

Route::get('/typeuser', function() {
    return view(('auth.typeUser'));
})->name('typeuser');

Route::get('/typeuserlogin', function() {
    return view(('auth.typeUserLogin'));
})->name('typeuserlogin');

Route::get('termos', function() {
    return view(('terms'));
})->name('termos');

// Rotas protegidas (precisam de autenticação)
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/denuncia', [DenunciaController::class, 'store'])->name('denuncia.store');
    Route::post('/comentarios', [ComentariosDenunciasController::class, 'store'])->name('comentarios.store');
    Route::put('/comentarios/{id}', [ComentariosDenunciasController::class, 'update'])->name('comentarios.update');
    Route::delete('/comentarios/{id}', [ComentariosDenunciasController::class, 'destroy'])->name('comentarios.destroy');

});
Route::post('/denuncias/{id}/curtir', [CurtidasDenunciasController::class, 'toggleCurtir'])
    ->middleware('auth')
    ->name('denuncias.curtir');

// Rdenuncias
Route::get('/cadastrar-denuncia', function () {
    return view('denuncias.cadastrar-denuncia');
})->name('denuncias.cadastrar-denuncia');

Route::post('/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');
Route::get('/denuncias/{id}/edit', [DenunciaController::class, 'edit'])->name('denuncias.editar-denuncias');
Route::put('/denuncias/{id}', [DenunciaController::class, 'update'])->name('denuncias.update');
Route::delete('/denuncias/{id}', [DenunciaController::class, 'destroy'])->name('denuncias.destroy');

Route::get('/acompanhar-denuncia', function () {
    return view('acompanhar-denuncia');
})->name('acompanhar-denuncia');

Route::get('/denuncias/{id}', [DenunciaController::class, 'show'])->name('denuncias.show-denuncia');

// Perfil
Route::get('/perfil/edit', [ProfileController::class, 'page'])
    ->name('profile.perfil')
    ->middleware('auth');
Route::put('perfil/{id}/update', [ProfileController::class, 'update'])->name('usuario.update');
Route::get('/perfil/user/{id}', [ProfileController::class, 'showPerfil'])->name('profile.showPerfil');

// rotas não ultilizada
// Avaliação
Route::view('/avaliacao/avaliacao-orgao-adm', 'avaliacao.avaliacao-orgao-adm');
Route::view('/avaliacao/avaliacao-orgao', 'avaliacao.avaliacao-orgao');

// Denúncias
Route::view('/denuncias/acompanhar-denuncia', 'denuncias.acompanhar-denuncia');
Route::view('/denuncias/apoiar-denuncia', 'denuncias.apoiar-denuncia'); //não necessaria
Route::view('/denuncias/denuncia-ad', 'denuncias.denunciaAD');
Route::view('/denuncias/enviar-mensagem-adm', 'denuncias.enviar-mensagem-adm');
Route::view('/denuncias/gerir-denuncias-adm', 'denuncias.gerir-denuncias-adm');
Route::view('/denuncias/visualizar-denuncia', 'denuncias.visualizar-denuncia');

// Feedback
Route::view('/feedback/feedback-orgao-adm', 'feedback.feedback-orgao-adm');
Route::view('/feedback/feedback-orgao', 'feedback.feedback-orgao');



