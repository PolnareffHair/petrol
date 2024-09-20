<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Arr;
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

    //contains basik ids img & parent id 
    $attributes_img  =  DB::table("oc_category")->get(['category_id', 'image', 'parent_id','sort_order'])->mapWithKeys(function ($item) {
        return [$item->category_id=> [
            'category_img_url' => $item->image,
            'category_parent' => $item->parent_id,
            'category_order_priority' => $item->sort_order
        ]];
    }) ;

    $result =$attributes_img= $attributes_img->toArray();
   
    foreach ($attributes_img as $key => &$value) {
        // Запрос данных для украинского языка
        $val_desc_ua = (array) DB::table("oc_category_description")
                            ->where(['category_id' => $key, 'language_id' => 3])
                            ->first();
        
        // Запрос данных для русского языка
        $val_desc_ru = (array) DB::table("oc_category_description")
                            ->where(['category_id' => $key, 'language_id' => 1])
                            ->first();
        
        // Если данные для украинского языка найдены
        $result[$key ]["category_id"]  = $key;
        if ($val_desc_ua) {
            $result[$key ]["category_name_ua"] = $val_desc_ua["name"] ?? '';
            $result[$key ]["category_url_ua"] = $val_desc_ua["seo_keyword"] ?? $val_desc_ru["seo_keyword"] ?? '';
            $result[$key ]["category_h1_ua"] = $val_desc_ua["meta_h1"] ?? '';
            $result[$key ]["category_description_tag_ua"] = $val_desc_ua["meta_description"] ?? '';
            $result[$key ]["category_description_ua"] = $val_desc_ua["description"] ?? '';
            $result[$key ]["category_title_ua"] = $val_desc_ua["meta_title"] ?? '';
        }
        // Если данные для русского языка найдены
        if ($val_desc_ru) {
            $result[$key ]["category_name_ru"] = $val_desc_ru["name"] ?? '';
            $result[$key ]["category_url_ru"] = $val_desc_ru["seo_keyword"] ?? $val_desc_ua["seo_keyword"] ?? '';
            $result[$key ]["category_h1_ru"] = $val_desc_ru["meta_h1"] ?? '';
            $result[$key ]["category_description_tag_ru"] = $val_desc_ru["meta_description"] ?? '';
            $result[$key ]["category_description_ru"] = $val_desc_ru["description"] ?? '';
            $result[$key ]["category_title_ru"] = $val_desc_ru["meta_title"] ?? '';
        }

        DB::table("categories")->insert($result[$key]);
    } 




    

   
    return    0;
})->purpose('generate categories based on  oc_')->hourly();
