<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('pages.dashboard.dashboard');
// });

// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home.index');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'Login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::put('/profileupdate',[ProfileController::class,'update'])->name('profile.update');
     /**
     * Route utilisateur
     */
    Route::controller(RegisterController::class)->group(function () {
        Route::prefix('/utilisateur')->group(function () {
            Route::name('utilisateur.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'delete')->name('delete');
            });
        });
    });
});
