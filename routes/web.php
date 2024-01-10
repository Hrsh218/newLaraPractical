<?php

use App\Helpers\LogActivity;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\QRCodeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
Route::get('category/index', [CategoryController::class, 'index'])->name('category.list');
Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');


Route::get('book/index',[BookController::class, 'index'])->name('book.list');
Route::get('book/create', [BookController::class, 'create'])->name('book.create');
Route::post('book/store', [BookController::class, 'store'])->name('book.store');
Route::get('book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::put('book/update/{id}', [BookController::class, 'update'])->name('book.update');
Route::post('book/delete/{id}',[BookController::class, 'destroy'])->name('book.delete');


Route::get('qr-code-generate', [QRCodeController::class, 'index'])->name('generate.log');

Route::get('logActivity', [LogActivityController::class, 'logActivity'])->name('log.activity.list');
});


