<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CaixaDiarioController;


Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/caixa/criar', [CaixaDiarioController::class, 'create'])->name('caixa.create');
    Route::post('/caixa', [CaixaDiarioController::class, 'store'])->name('caixa.store');
    
    Route::get('/caixa/{caixa}/editar', [CaixaDiarioController::class, 'edit'])->name('caixa.edit');
    Route::put('/caixa/{caixa}', [CaixaDiarioController::class, 'update'])->name('caixa.update');
    Route::get('/caixa/{caixa}', [CaixaDiarioController::class, 'show'])->name('caixa.show');
    Route::delete('/caixa/{caixa}', [CaixaDiarioController::class, 'destroy'])->name('caixa.destroy');


    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/perfil/editar', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/configuracoes', [ProfileController::class, 'settings'])->name('settings');

    Route::post('/configuracoes/atualizar', [ProfileController::class, 'updateSettings'])->name('settings.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//post ->salvar
//get -> mostrar formulario & editar
//put -> atualizar