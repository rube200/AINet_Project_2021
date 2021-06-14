<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\UserController;
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

Auth::routes(['register' => false, 'verify' => true]);
Route::get('/', [EstampaController::class, 'index'])->name('index');
Route::resource('estampa', EstampaController::class);
Route::resource('profile', UserController::class);
Route::delete('profile/{user}/resetphoto', [UserController::class, 'resetPhoto'])->name('profile.photo.destroy')->middleware('can:edit,user');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
});
