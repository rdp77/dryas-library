<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\BookLoanController;
use App\Http\Controllers\Book\BookReturnController;
use App\Http\Controllers\Book\BookshelfController;
use App\Http\Controllers\Book\BookAuthorController;
use App\Http\Controllers\Book\BookPublisherController;
use App\Http\Controllers\Book\BookCategoryController;
use App\Http\Controllers\PrevilegesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/dashboard', [HomeController::class, 'index'])
    ->name('home');

Auth::routes();

Route::group(['middleware' => 'roles'], function () {
    Route::resources([
        'users' => UserController::class,
        'previleges' => PrevilegesController::class,
        'faculty' => FacultyController::class,
        'major' => MajorController::class,
        'book' => BookController::class,
        'book-loan' => BookLoanController::class,
        'book-return' => BookReturnController::class,
        'author' => BookAuthorController::class,
        'category' => BookCategoryController::class,
        'publisher' => BookPublisherController::class,
        'bookshelf' => BookshelfController::class,
    ]);

    Route::prefix('user')->group(function () {
        Route::get('/extends', [UserController::class, 'extends'])
            ->name('userExtends');
        // Profile
        Route::resource('profile', ProfileController::class)->only(['index', 'edit', 'update']);
        // Profile Password
        Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
            ->name('user.forgotPassword');
        Route::get('/change-password', [ForgotPasswordController::class, 'changepassword'])
            ->name('user.changePassword');
        Route::get('/reset-password', [ForgotPasswordController::class, 'logout'])
            ->name('user.resetPassword');
        Route::get('/print/idcard', [UserController::class, 'profileprint'])
            ->name('user.profile.print');
    });

    Route::get('/transaksi_peminjaman_get_data_buku', [BookLoanController::class, 'get_data_buku'])
        ->name('transaksi_peminjaman_get_data_buku');
    Route::get('/transaksi_peminjaman_get_data_buku_remove', [BookLoanController::class, 'get_data_buku_remove'])
        ->name('transaksi_peminjaman_get_data_buku_remove');
});

require __DIR__ . '/frontend.php';