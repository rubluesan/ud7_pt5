<?php

use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\ClienteController;


// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [DefaultController::class, 'home'])->name('home');

// CUENTAS
Route::get('/cuenta/list', [CuentaController::class, 'list'])->name('cuenta_list');
Route::match(['get', 'post'], '/cuenta/new', [CuentaController::class, 'new'])->name('cuenta_new');
Route::get('/cuenta/delete/{id}', [CuentaController::class, 'delete'])->name('cuenta_delete');
Route::match(['get', 'post'], '/cuenta/edit/{id}', [CuentaController::class, 'edit'])->name('cuenta_edit');

// CLIENTES
Route::get('/cliente/list', [ClienteController::class, 'list'])->name('cliente_list');
Route::match(['get', 'post'],'/cliente/new', [ClienteController::class, 'new'])->name('cliente_new');
Route::get('/cliente/delete/{id}', [ClienteController::class, 'delete'])->name('cliente_delete');
Route::match(['get', 'post'], '/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente_edit');

// Dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//autenticacion
Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

require __DIR__.'/auth.php';
