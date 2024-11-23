<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReportController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/create-user', [UserController::class, 'create'])->name('users.create');

    Route::post('/store-user', [UserController::class, 'store'])->name('users.store');

    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('users.update');

    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/generate-pdf-users', [UserReportController::class, 'generatePdf'])->name('users.generate-pdf');

    Route::get('/generate-csv-users', [UserReportController::class, 'generateCsv'])->name('users.generate-csv');
    
    // Professores
    Route::get('/professores', [ProfessoresController::class, 'listar'])->name('professores.listar');

    Route::get('/ver-professor/{prof}', [ProfessoresController::class, 'ver'])->name('professores.ver');

    Route::get('/criar-professor', [ProfessoresController::class, 'criar'])->name('professores.criar');
    Route::post('/salvar-professor', [ProfessoresController::class, 'salvar'])->name('professores.salvar');

    Route::get('/editar-professor/{prof}', [ProfessoresController::class, 'editar'])->name('professores.editar');

    Route::put('/atualizar-professor/{prof}', [ProfessoresController::class, 'atualizar'])->name('professor.atualizar');

    Route::delete('/destroy-professor/{prof}', [ProfessoresController::class, 'destroy'])->name('professores.destroy');

    Route::get('/gerar-pdf-professores', [ProfReportController::class, 'gerarPdfProf'])->name('professores.gerar-pdf');

    Route::get('/gerar-csv-professores', [ProfReportController::class, 'gerarCsv'])->name('professores.gerar-csv');

});

require __DIR__ . '/auth.php';
