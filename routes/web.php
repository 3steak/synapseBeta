<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MagicLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login/magic', [MagicLoginController::class, 'showForm'])->name('magic.login.form');
Route::post('/login/magic', [MagicLoginController::class, 'sendToken'])
    ->name('magic.login.send');
Route::get('/login/magic/{token}', [MagicLoginController::class, 'loginWithToken'])->name('magic.login.token');

// Import des routes liées à l'authentification

// ROLE
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('/users', Admin\UserController::class);
    Route::resource('/functions', Admin\FunctionController::class);
    Route::get('/history', [Admin\HistoryController::class, 'index'])->name('history.index');
});

Route::middleware(['role:Scientist'])->group(function () {
    // Routes accessibles uniquement aux scientifiques
});


require __DIR__ . '/auth.php';
