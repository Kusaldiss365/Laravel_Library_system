<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::post('/book',[BookController::class, 'store'])->name('book.store');
Route::get('/book/{id}',[BookController::class, 'bookById'])->name('bookById');
Route::put('/book/{id}',[BookController::class, 'edit'])->name('book.edit');
Route::delete('/book/{id}',[BookController::class,'deleteBook'])->name('book.deleteBook');