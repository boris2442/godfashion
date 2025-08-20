<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {
    Route::get('/clients', [ClientController::class, 'index'])->name('admin.clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('admin.clients.create');
    Route::post('/clients/store', [ClientController::class, 'store'])->name('admin.clients.store');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('admin.clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('admin.clients.update');

    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('admin.clients.show');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');


    // Routes for Commandes
    Route::get('/commandes/create', [CommandeController::class, 'create'])->name('admin.commandes.create');
    Route::post('/commandes/store', [CommandeController::class, 'store'])->name('admin.commandes.store');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('admin.commandes.index');
    Route::get('/commandes/{id}/edit', [CommandeController::class, 'edit'])->name('admin.commandes.edit');
    Route::put('/commandes/{id}', [CommandeController::class, 'update'])->name('admin.commandes.update');
    Route::delete('commandes/{commande}', [CommandeController::class, 'destroy'])->name('admin.commandes.destroy');

    Route::get('/commandes/{id}', [CommandeController::class, 'show'])->name('admin.commandes.show');

    // Routes for Users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
});
require __DIR__ . '/auth.php';
