<?php

use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::get('/', function () {
    return view('welcome');
});

//Rotas privadas - necessário autenticação
Route::group(['middleware' => ['auth:sanctum', 'verified'] ], function(){
    //chamada das rotas
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/usuarios/lista', \App\Http\Livewire\Usuarios\Lista::class)->name('usuarios.lista');
});
