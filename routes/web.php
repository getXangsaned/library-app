<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RentController;

Route::get('/library', [BookController::class, 'index'])->name('book.index');
Route::get('/library/add', [BookController::class, 'create'])->name('book.create');
Route::post('/library', [BookController::class, 'store'])->name('book.store');
Route::get('/library/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('/library/{book}/update', [BookController::class, 'update'])->name('book.update');
Route::delete('/library/{book}/delete', [BookController::class, 'delete'])->name('book.delete');
Route::get('/books/search', [BookController::class, 'search'])->name('book.search');

Route::get('/rent', [RentController::class, 'rentindex'])->name('rent.index');
Route::get('/rent/create', [RentController::class, 'create'])->name('rent.create');
Route::post('/rent/store', [RentController::class, 'store'])->name('rent.store');
Route::post('/rent/{rent_id}/return', [RentController::class, 'return'])->name('rent.return');
Route::post('/rent/pay/{rent_id}', [RentController::class, 'pay'])->name('rent.pay');
Route::get('/rent/search', [RentController::class, 'search'])->name('rent.search');
