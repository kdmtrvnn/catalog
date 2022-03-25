<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\CatalogController;

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

Route::get('/', [BookController::class, 'show'])->name('show');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('add', [CatalogController::class, 'add'])->name('add');
        Route::post('create', [CatalogController::class, 'create'])->name('create');
        Route::get('get', [CatalogController::class, 'getBooks'])->name('get');
        Route::get('edit/{id}', [CatalogController::class, 'edit'])->name('edit');
        Route::post('update', [CatalogController::class, 'update'])->name('update');
        Route::post('delete/{id}', [CatalogController::class, 'delete'])->name('delete');
    });

    Route::prefix('authors')->name('authors.')->group(function () {
        Route::get('get', [CatalogController::class, 'getAuthors'])->name('get');
    });
});

require __DIR__.'/auth.php';