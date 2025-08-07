<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CandidatoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('vagas', VagaController::class);
Route::post('/vagas/{vaga}/inscrever', [VagaController::class, 'inscrever'])->name('vagas.inscrever');
Route::resource('candidatos', CandidatoController::class);
Route::delete('/vagas/{vaga}/candidatos/{candidato}', [VagaController::class, 'cancelarInscricao'])->name('vagas.cancelarInscricao');
