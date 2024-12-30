<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::middleware(['customer'])->group(function () {
        Route::post("become-seller", [DashController::class, "becomeSeller"])->name("becomeSeller");
    });

    Route::middleware(['seller'])->group(function () {
        // Liste des produits
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');

        // Enregistrement d'un produit
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');

        // Mise à jour d'un produit
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

        // Suppression d'un produit
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::get('/', [DashController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
