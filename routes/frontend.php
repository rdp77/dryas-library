<?php

use App\Http\Controllers\FrontEndController;
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

Route::get('/', [FrontEndController::class, 'index'])
    ->name('pages.home');
Route::get('/team', [FrontEndController::class, 'team'])
    ->name('pages.team');
Route::get('/about', [FrontEndController::class, 'about'])
    ->name('pages.about');
Route::get('/catalog', [FrontEndController::class, 'catalog'])
    ->name('pages.catalog');