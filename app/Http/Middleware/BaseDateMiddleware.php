<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductsDataController;
use Illuminate\Support\Facades\Auth;

class BaseDateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next)
    {

        $header_data["currentUser"] = Auth::user();
        $header_data["isAuth"] = Auth::check();
        $header_data['favorites']  = ProductsDataController::getFavoriteProducts();
        $header_data['compares']   = ProductsDataController::getCompareProducts();

        $header_data["compare_counter"]  = session()->get('compare_counter');
        $header_data['basket_counter'] = count(session()->get('cart') ?? []);

        $header_data['cart'] = session()->get('cart', []);

        $header_data['lang'] = app()->getLocale();
        

        // Делаем переменную доступной для всех представлений
        view()->share('header_data', $header_data);
        // Либо, альтернативно, используя контейнер приложения app()
        app()->instance('cartItems', $header_data);

        return $next($request);

    }
}
