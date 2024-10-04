<?php
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminMiddleware;



use App\Http\Controllers\Admin\AdminProductController;

use App\Http\Controllers\Admin\editors\ImgProductAdminController;
use App\Http\Controllers\Admin\editors\TagProductAdminController;
use App\Http\Controllers\Admin\editors\RelatedProductAdminController;
use App\Http\Controllers\Admin\editors\CatProductAdminController;

use App\Http\Controllers\Admin\editors\VideoProductController;

use App\http\Controllers\CategoryController;


//midle ware checks if user have adm == 1 
Route::middleware([AdminMiddleware::class])->group(function () {

 


    Route::post('/admin/product_edit/cats_edit/create',[CatProductAdminController::class, "create"]); /*** */
    Route::post('/admin/product_edit/cats_edit/read', [CatProductAdminController::class, "read"]); /*** */
    Route::post('/admin/product_edit/cats_edit/update', [CatProductAdminController::class, "update"]); /*** */
    Route::post('/admin/product_edit/cats_edit/delete', [CatProductAdminController::class, "delete"]);  /*** */

       
    Route::post('/admin/product_edit/rel_edit/search', [RelatedProductAdminController::class, "searchProducts"]);

    Route::post('/admin/product_edit/rel_edit/read', [RelatedProductAdminController::class, "read"]); /*** */
    Route::post('/admin/product_edit/rel_edit/delete', [RelatedProductAdminController::class, "delete"]);  /*** */
    Route::post('/admin/product_edit/rel_edit/create',    [RelatedProductAdminController::class, "add"]); /*** */
    Route::post('/admin/product_edit/rel_edit/update', [RelatedProductAdminController::class, "update"]); /*** */


    Route::post('/admin/product_edit/Video/read', [VideoProductController::class, "get"]);

    Route::POST('/admin/product_edit/Video/uppdate', [VideoProductController::class, "update"]);

    Route::post('/admin/product_edit/Video/create', [VideoProductController::class, "add"]);

    Route::post('/admin/product_edit/Video/delete', [VideoProductController::class, "delete"]);
   

    Route::get('/admin/product/{id}', [AdminProductController::class, "product"]);


    Route::post('/admin/product_edit/attr_edit/create',    [TagProductAdminController::class, "add"]); /*** */
    Route::post('/admin/product_edit/attr_edit/read', [TagProductAdminController::class, "get_tags"]); /*** */
    Route::post('/admin/product_edit/attr_edit/update', [TagProductAdminController::class, "update"]); /*** */
    Route::post('/admin/product_edit/attr_edit/delete', [TagProductAdminController::class, "delete"]);  /*** */


    
    Route::post('/admin/product_edit/img/read', [ImgProductAdminController::class, "get"]);
    Route::POST('/admin/product_edit/img/update', [ImgProductAdminController::class, "update"]);
    Route::post('/admin/product_edit/img/create', [ImgProductAdminController::class, "add"]);
    Route::post('/admin/product_edit/img/delete', [ImgProductAdminController::class, "delete"]);
   
    

    
    Route::get('/admin', [AdminProductController::class, "index"]);


    Route::post('/uppdate_main_page_text', [AdminProductController::class, "uppdate_main_page_text"]);
   
    Route::post('/admin/product_edit/duplicate', [AdminProductController::class, "duplicate"]);

    Route::POST('/admin/uppdate_product', [AdminProductController::class, "uppdate_product"]);
    Route::POST('/admin/delete_product', [AdminProductController::class, "delete_product"]);

    
    //category + 

    //attributes +

    //imgaes + 
    
    //basic data +

    Route::POST('/admin/duplicate_product', [AdminProductController::class, "duplicate_product"]);



});
