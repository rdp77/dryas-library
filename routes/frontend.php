<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register frontend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "frontend" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/team', function () {
    return view('pages.team');
})->name('team');
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
Route::get('/catalog', 'catalogController@getCatalog')->name('catalog');