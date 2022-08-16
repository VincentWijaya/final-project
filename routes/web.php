<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RegisteredUserController::class, 'create'])
->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/book', [BookController::class, 'index'])->middleware(['auth'])->name('book');
Route::post('/book', [BookController::class, 'create'])->middleware(['auth'])->name('book.create');
Route::get('/book/{id}', [BookController::class, 'update'])->middleware(['auth'])->name('book.edit');
Route::put('/book/{id}', [BookController::class, 'update'])->middleware(['auth'])->name('book.edit');
Route::delete('/book/{id}', [BookController::class, 'destroy'])->middleware(['auth'])->name('book.destroy');

Route::post('/order/${book_id}', [OrderController::class, 'create'])->middleware(['auth'])->name('order.create');

require __DIR__.'/auth.php';
