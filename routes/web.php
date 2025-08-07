<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VagaController; 
use App\Http\Controllers\CandidatoController; 
use Illuminate\Support\Facades\Route;


// Rota da página inicial pública
Route::get('/', function () {
    return view('welcome');
});

// Rota do Dashboard (já vem protegida pelo Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// AGRUPAMENTO DE ROTAS PROTEGIDAS
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('vagas', VagaController::class);
    Route::resource('candidatos', CandidatoController::class);

    Route::post('/vagas/{vaga}/inscrever', [VagaController::class, 'inscrever'])->name('vagas.inscrever');
    Route::delete('/vagas/{vaga}/candidatos/{candidato}', [VagaController::class, 'cancelarInscricao'])->name('vagas.cancelarInscricao');
});


require __DIR__.'/auth.php';