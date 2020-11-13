<?php

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

// Book Routes
Route::post('/store', [App\Http\Controllers\BookController::class, 'store'])->name('books.store');
Route::patch('/update/{book}', [App\Http\Controllers\BookController::class, 'update'])->name('books.update');
Route::delete('/destroy/{book}', [App\Http\Controllers\BookController::class, 'destroy'])->name('books.destroy');

// Author Routes
Route::post('/author/store', [App\Http\Controllers\AuthorController::class, 'store'])->name('authors.store');