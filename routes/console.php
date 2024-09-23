<?php

use Illuminate\Foundation\Inspiring;

use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\DB;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('sat', function () {
    $this->comment("lolo");
})->purpose('Display an inspiring quote')->hourly();



Artisan::command('generate_existattr_onattr-prdct-list', function () {

    $uniqueValues =  DB::table("attributes_values")
        ->get();

    $attributes = [];

    foreach ($uniqueValues as $value) {

        $value = (array)$value;

        if (!isset($attributes[$value["atribute_id"]]["ua"])) {
            $attributes[$value["atribute_id"]] = [];
            $attributes[$value["atribute_id"]]["ua"] = [];
            $attributes[$value["atribute_id"]]["ru"] = [];
        }

        if (!in_array($value["atribute_name_ua"], $attributes[$value["atribute_id"]]["ua"])) {
            array_push($attributes[$value["atribute_id"]]["ua"], $value["atribute_name_ua"]);
            array_push($attributes[$value["atribute_id"]]["ru"], $value["atribute_name_ru"]);
        }
    }

    foreach ($attributes as $id => $value) {
        foreach ($value["ru"] as $key => $item_ru) {
            DB::table("attributes_values_exist")->insert([
                "attr_id" => $id,
                "val_name_ru" => $item_ru,
                "val_name_ua" => $value["ua"][$key]
            ]);
        }
    }
    return    0;
})->purpose('generate_existattr_onattr-prdct-list')->hourly();



Artisan::command('gen_cat', function () {
    $id = 1004;
    $dir =  getcwd() . '\public\images\product';
    $files = glob("$dir/$id"."_*");



    return var_dump(  $files );     
})->purpose('generate categories based on  oc_')->hourly();
