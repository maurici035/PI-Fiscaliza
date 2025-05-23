<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\HomeController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/denuncias', [DenunciaController::class, 'store']);
Route::get('/cadastro', function() {
    return view('cadastro');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::post('/denuncia', [DenunciaController::class, 'store'])->name('denuncia.store');






