<?php


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\DB;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('sat', function () {
    $this->comment("lolo");
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('copy_cat', function () {

        $products  = (array) DB::table( "products")->get("product_id")->map(function ($item){   return (array) $item;})->toArray(); 
        foreach($products as $product)
        {
            $relAdd = DB::table( "product_related")->where("product_id",$product)->pluck("related_id")->toArray(); 
    
            DB::table( "products")->where("product_id",$product)->update(["product_related"=> json_encode($relAdd ?? [])]) ;    
        }

})->purpose('generate categories based on  oc_')->hourly();
