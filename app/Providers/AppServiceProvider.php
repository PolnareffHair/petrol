<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Якщо шлях починаеться з юа то встановлюеться мова юа якщо ні то ру
        $lang = request()->is('ua*') ? 'ua' : 'ru';
        app()->setLocale($lang);        


    }
}