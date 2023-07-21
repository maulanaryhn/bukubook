<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::controller(UserController::class)
        // prefix url
        ->prefix('user')
        // prefix name
        ->name('user.')
        //middleware auth, hanya untuk user yang sudah login
        // ->middleware(['auth'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create')->can('create-user');
            Route::post('/', 'store')->name('store')->can('create-user');
            Route::get('/{user}/show', 'show')->name('show');
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::put('/{user}', 'update')->name('update');
            Route::delete('/{user}', 'destroy')->name('delete');
        });

    Route::resource('category', CategoryController::class);

    Route::controller(BookController::class)
        ->prefix('book')
        ->name('book.')
        ->group(function () {
            Route::get('summary', 'summary')->name('summary'); // route untuk halaman custome
        });

    Route::resource('book', BookController::class);
});
