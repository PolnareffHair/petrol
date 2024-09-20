<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next)
    {
        // Проверяем, есть ли параметр 'check' в запросе
        if (!$request->has('check')) {
            // Если параметра нет, перенаправляем на главную страницу
            return redirect('/');
        }

        // Если параметр есть, продолжаем выполнение запроса
        return $next($request);
    }
}
