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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function () {
    return view('welcome2');
});

Route::resources([
    'books' => App\Http\Controllers\BookController::class,
]);















Route::post('books/{id}/active', 'App\Http\Controllers\BookController@active')->name('books.active');
