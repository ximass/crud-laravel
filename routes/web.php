<?php

use App\Http\Controllers\PessoasController;
use Illuminate\Support\Facades\Route;

Route::resource('/', PessoasController::class);

Route::post('pessoas-form', [PessoasController::class, 'store']);

Route::put('pessoa-update/{id}', [PessoasController::class, 'update']);

Route::delete('pessoa-deletar/{id}', [PessoasController::class, 'destroy']);