<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasketOperationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsDataController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\Call_Me_Controller;
use App\Http\Controllers\CompareOperationController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::post('/call_me', [Call_Me_Controller::class, 'create']);
Route::post('/order_product', [OrderProductController::class, 'create']);

Route::post('/get_product_order', [ProductsDataController::class, 'getProductOrder']);


Route::post('/guest_basket_add', [BasketOperationController::class, 'GuestAddProduct']);
Route::post('/guest_basket_get', [BasketOperationController::class, 'GuestShowProducts']);
Route::post('/guest_change', [BasketOperationController::class, 'GuestChangeProducts']);
Route::post('/guest_basket_del', [BasketOperationController::class, 'GuestDeleteProducts']);
Route::post('/guest_basket_counter', [BasketOperationController::class, 'GuestCountProducts']);

Route::POST('/fav_add', [ProfileController::class, 'add_favorites']);

Route::POST('/fav_remove', [ProfileController::class, 'remove_favorites']);

Route::POST('/fav_show', [ProfileController::class, 'show_favorites']);


Route::POST('/add_compare', [CompareOperationController::class, 'GuestAddCompare']);

Route::POST('/remove_compare', [CompareOperationController::class, 'GuestRemoveCompare']);
Route::POST('/clear_compare', [CompareOperationController::class, 'GuestClearCompare']);

Route::POST('/comp_show', [CompareOperationController::class, 'GuestShowCompare']);
Route::get('/comp_show', [CompareOperationController::class, 'GuestShowCompare']);


Route::post("/dashboards", [UserDataController::class, "SetData"])->middleware('throttle:10,1');

Route::middleware('auth')->group(function () {
    Route::get('/user_favor', [UserDataController::class, 'GetFavoritesProducts'])->name('profile.edit');
    Route::get('/user_favorite_remove', [UserDataController::class, 'GetFavoritesProducts'])->name('profile.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profiles', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profiles', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
