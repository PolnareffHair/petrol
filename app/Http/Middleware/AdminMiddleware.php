<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Проверяем, авторизован ли пользователь и имеет ли он право администратора
        if (Auth::check() && Auth::user()->adm == 1) {
            // Если пользователь администратор, продолжаем выполнение запроса
            return $next($request);
        }
        // Если не администратор, перенаправляем на главную страницу
        return redirect('/');
    }
}
