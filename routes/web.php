<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatreleaseController;
use App\Http\Controllers\BookController;

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
    return view('layout');
});
/*Route::get('/statrelese', 'App\Http\Controllers\StatreleaseController@show');*/

Route::resource('statreleases',StatreleaseController::class);

Route::resource('books',BookController::class);

Route::get('/search', 'App\Http\Controllers\BookController@search')->name('search');



