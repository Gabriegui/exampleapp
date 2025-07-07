<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TelefoneController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', [RegisteredUserController::class, 'show'])->name('dashboard');
Route::get('edit-pessoa/{id}', [RegisteredUserController::class, 'edit'])->name('edit-pessoa');
Route::put('update-pessoa/{id}', [RegisteredUserController::class, 'update'])->name('update-pessoa');
Route::delete('delete-pessoa/{id}', [RegisteredUserController::class, 'destroy'])->name('delete-pessoa');

Route::get('lista-politicos', [AuthenticatedSessionController::class, 'show'])->name('lista-politicos');
Route::get('edit-politico/{id}', [AuthenticatedSessionController::class, 'edit'])->name('edit-politico');
Route::put('update-politico/{id}', [AuthenticatedSessionController::class, 'update'])->name('update-politico');
Route::delete('delete-politico/{id}', [AuthenticatedSessionController::class, 'destroy'])->name('delete-politico');

Route::get('register-telefone', [TelefoneController::class, 'create'])->name('register-telefone');
Route::get('lista-telefone', [TelefoneController::class, 'show'])->name('lista-telefone');
Route::get('edit-telefone/{id}', [TelefoneController::class, 'edit'])->name('edit-telefone');
Route::put('update-telefone/{id}', [TelefoneController::class, 'update'])->name('update-telefone');
Route::delete('delete-telefone/{id}', [TelefoneController::class, 'destroy'])->name('delete-telefone');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';