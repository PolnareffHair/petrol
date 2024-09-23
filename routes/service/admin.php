<?php
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminMiddleware;

use App\Http\Controllers\AttributeController;

use App\Http\Controllers\Admin\AdminOpertaionController;

use App\Http\Controllers\Admin\ImgProductAdminController;
use App\Http\Controllers\Admin\TagProductAdminController;

use App\http\Controllers\CategoryController;


//midle ware checks if user have adm == 1 
Route::middleware([AdminMiddleware::class])->group(function () {


    Route::get('/admin', [AdminOpertaionController::class, "index"]);

    Route::get('/admin', [AdminOpertaionController::class, "index"]);

    Route::get('/admin/product_edit/tags/{id}', [TagProductAdminController::class, "get"]);

    Route::post('/admin/product_edit/tags/content', [TagProductAdminController::class, "get_tags"]);

    Route::post('/admin/product_edit/tags_edit/delete', [TagProductAdminController::class, "delete"]);
    Route::post('/admin/product_edit/tags_edit/add', [TagProductAdminController::class, "add"]);
    Route::post('/admin/product_edit/tags_edit/uppdate', [TagProductAdminController::class, "update"]);

    Route::get('/admin/product_edit/tags_edit/add/{id}', [TagProductAdminController::class, "get"]);




    Route::post('/uppdate_main_page_text', [AdminOpertaionController::class, "uppdate_main_page_text"]);

    Route::POST('/admin/uppdate_product', [AdminOpertaionController::class, "uppdate_product"]);

    Route::POST('/admin/delete_product', [AdminOpertaionController::class, "delete_product"]);
    
    //category + 

    //attributes +

    //imgaes + 

    //basic data +

    Route::POST('/admin/duplicate_product', [AdminOpertaionController::class, "duplicate_product"]);

    Route::get('/admin/product_edit/img/get/{id}', [ImgProductAdminController::class, "get"]);

    Route::POST('/admin/product_edit/img/uppdate', [ImgProductAdminController::class, "update"]);

    Route::post('/admin/product_edit/img/add', [ImgProductAdminController::class, "add"]);

    Route::post('/admin/product_edit/img/delete', [ImgProductAdminController::class, "delete"]);



    Route::get('/admin/product_edit/cat/get', [CategoryController::class, "get"]);
    Route::get('/admin/product_edit/cat/get', [CategoryController::class, "update"]);

    Route::get('/admin/product_edit/att/get', [AttributeController::class, "get"]);    
    Route::get('/admin/product_edit/att/get', [AttributeController::class, "update"]);
    
    
    Route::get('/admin/product/{id}', [AdminOpertaionController::class, "product"]);
});
