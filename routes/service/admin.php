<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttributeController;
use App\http\Controllers\CategoryController;

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, "index"]);

    Route::post('/uppdate_main_page_text', [AdminController::class, "uppdate_main_page_text"]);

    Route::POST('/admin/uppdate_product', [AdminController::class, "uppdate_product"]);
    Route::POST('/admin/delete_product', [AdminController::class, "delete_product"]);
    
    //category
    //attributes
    //imgaes
    //basic data
    Route::POST('/admin/duplicate_product', [AdminController::class, "duplicate_product"]);

    Route::get('/admin/product_edit/img/get/{id}', [AdminController::class, "get_img"]);
    Route::POST('/admin/product_edit/img/uppdate', [AdminController::class, "img_update"]);
    Route::post('/admin/product_edit/img/add', [AdminController::class, "img_add"]);
    Route::post('/admin/product_edit/img/delete', [AdminController::class, "img_delete"]);

    Route::get('/admin/product_edit/cat/get', [CategoryController::class, "get"]);
    Route::get('/admin/product_edit/cat/get', [CategoryController::class, "update"]);

    Route::get('/admin/product_edit/att/get', [AttributeController::class, "get"]);    
    Route::get('/admin/product_edit/att/get', [AttributeController::class, "update"]);
    
    
    Route::get('/admin/product/{id}', [AdminController::class, "product"]);
});
