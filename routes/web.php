<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductsDataController;
use App\Http\Controllers\ShopPagesController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\img;
use Illuminate\Support\Facades\Route;

use App\http\Middleware\BaseDateMiddleware;


$some_function = function () {
    return $lang = app()->getLocale();
};

Route::get('/send',function(){ return view("sender");});

//Надає базову інформацію про кошик порівнння юзера і т д
Route::middleware([BaseDateMiddleware::class])->group(function() use ($some_function) {

    Route::get('/cas', [RegisteredUserController::class, "store"]);


    Route::get('/set_all', [ProductsDataController::class, "set_images"]);

    Route::get('/constructor', $some_function);

    Route::get('/blog', $some_function);

    Route::get('/setimg', [img::class, "ImageAddMicro"]);

    Route::get('/', [ShopPagesController::class, 'get_main_page']);

    Route::get('/category/{url}', [ProductsDataController::class, "get_category"]);

    Route::get('/product/{id}', [ProductsDataController::class, "get_product"]);

    Route::get("/dashboards", [MainController::class, "dashboard"])->name("dashboard");

    Route::prefix("ua")->group(function () use ($some_function) {
        Route::get("/dashboards", [MainController::class, "dashboard"])->name("dashboard");
        Route::get('/', [ShopPagesController::class, 'get_main_page']);
        Route::get('/constructor', $some_function)->name("constructor");

        Route::get('/blog', $some_function)->name("blog");
        Route::get('/category/{url}', [ProductsDataController::class, "get_category"]);
        Route::get('/product/{id}', [ProductsDataController::class, "get_product"]);
    });


    Route::get('/search', [SearchController::class, "Search"]);
    Route::post('/upload-image', [img::class, 'processImage']);

    }
);



require __DIR__ . '/auth.php';
require __DIR__ . '/service/user_additions.php';
require __DIR__ . '/service/admin.php';