<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;



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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// routes/web.php





Route::resource('messages', \App\Http\Controllers\MessageController::class);
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::middleware(['auth', 'role:2'])->resource('admin', \App\Http\Controllers\AdminController::class);
Route::middleware(['auth', 'role:2'])->resource('soldes', \App\Http\Controllers\SoldeController::class);

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::patch('/products/{id}', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update');

