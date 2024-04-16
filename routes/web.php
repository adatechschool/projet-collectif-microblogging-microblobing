<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\welcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes pour les utilisateurs connectés
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/home', welcomeController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy']);
});

// Routes pour les utilisateurs non connectés
Route::middleware('guest')->group(function () {
    Route::get('/', [welcomeController::class, 'guestIndex']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/users/{id}', [ProfileController::class, 'show'])->name('users.show');


Route::get('/user/{id}', [PostController::class, 'show']);
Route::get('/search', [ProfileController::class, 'search']);



Route::resource('posts', PostController::class)

    ->only(['index', 'store', 'edit', 'update', 'destroy'])

    ->middleware(['auth', 'verified']);