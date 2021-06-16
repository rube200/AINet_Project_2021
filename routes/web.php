<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\EstampaController;
use App\Http\Controllers\PrecoController;
use App\Http\Controllers\ShopController;
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
Route::get('/', [ShopController::class, 'index'])->name('index');
Route::get('shopManage', [ShopController::class, 'shopManage'])->name('shopManage')->middleware('can:isAdmin,App\Models\User');

Route::delete('profile/{user}/resetphoto', [UserController::class, 'resetPhoto'])->name('profile.photo.destroy')->middleware('can:edit,user');
Route::resources([
    'estampa' => EstampaController::class,
    'profile' => UserController::class,
]);
Route::resources([
    'categoria' => CategoriaController::class,
    'cor' => CorController::class,
], ['except' => ['show']]);

Route::get('preco/edit', [PrecoController::class, 'edit'])->name('preco.edit')->middleware('can:isAdmin,App\Models\User');
Route::put('preco', [PrecoController::class, 'update'])->name('preco.update')->middleware('can:isAdmin,App\Models\User');

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
    Route::post('remove/{productId}', [CartController::class, 'remove'])->name('remove');
});
