<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes(['verify' => true]);
Route::get('/', [ShopController::class, 'index'])->name('index');
Route::get('estampa/{estampa}', [ShopController::class, 'show'])->middleware('can:view,estampa')->name('estampa.view');

Route::middleware('verified')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index')->middleware('can:view,App\Models\User');
    Route::get('list', [ProfileController::class, 'profiles'])->name('list')->middleware('can:viewAny,App\Models\User');
    Route::get('{profile}', [ProfileController::class, 'edit'])->name('edit');
});

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
});
