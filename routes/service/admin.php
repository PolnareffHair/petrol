<?php
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminMiddleware;



use App\Http\Controllers\Admin\AdminProductController;

use App\Http\Controllers\Admin\ImgProductAdminController;
use App\Http\Controllers\Admin\TagProductAdminController;

use App\Http\Controllers\Admin\CatProductAdminController;

use App\Http\Controllers\Admin\VideoProductController;

use App\http\Controllers\CategoryController;


//midle ware checks if user have adm == 1 
Route::middleware([AdminMiddleware::class])->group(function () {



    
    Route::post('/admin/product_edit/cats_edit/content', [CatProductAdminController::class, "get"]); /*** */
    Route::post('/admin/product_edit/cats_edit/delete', [CatProductAdminController::class, "delete"]);  /*** */
    Route::post('/admin/product_edit/cats_edit/add',    [CatProductAdminController::class, "add"]); /*** */
    Route::post('/admin/product_edit/cats_edit/uppdate', [CatProductAdminController::class, "update"]); /*** */





    Route::post('/admin/product_edit/Video/get', [VideoProductController::class, "get"]);

    Route::POST('/admin/product_edit/Video/uppdate', [VideoProductController::class, "update"]);

    Route::post('/admin/product_edit/Video/add', [VideoProductController::class, "add"]);

    Route::post('/admin/product_edit/Video/delete', [VideoProductController::class, "delete"]);
   

    Route::get('/admin/product/{id}', [AdminProductController::class, "product"]);



    Route::post('/admin/product_edit/tags/content', [TagProductAdminController::class, "get_tags"]); /*** */
    Route::post('/admin/product_edit/tags_edit/delete', [TagProductAdminController::class, "delete"]);  /*** */
    Route::post('/admin/product_edit/tags_edit/add',    [TagProductAdminController::class, "add"]); /*** */
    Route::post('/admin/product_edit/tags_edit/uppdate', [TagProductAdminController::class, "update"]); /*** */



    
    Route::get('/admin', [AdminProductController::class, "index"]);
    


    Route::post('/uppdate_main_page_text', [AdminProductController::class, "uppdate_main_page_text"]);
    Route::POST('/admin/uppdate_product', [AdminProductController::class, "uppdate_product"]);
    Route::POST('/admin/delete_product', [AdminProductController::class, "delete_product"]);

    
    //category + 

    //attributes +

    //imgaes + 
    
    //basic data +

    Route::POST('/admin/duplicate_product', [AdminProductController::class, "duplicate_product"]);

    Route::post('/admin/product_edit/img/get', [ImgProductAdminController::class, "get"]);

    Route::POST('/admin/product_edit/img/uppdate', [ImgProductAdminController::class, "update"]);

    Route::post('/admin/product_edit/img/add', [ImgProductAdminController::class, "add"]);

    Route::post('/admin/product_edit/img/delete', [ImgProductAdminController::class, "delete"]);
   
    

});
