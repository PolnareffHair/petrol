<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductsDataController;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

    use Illuminate\Support\Facades\Log;


class ShopPagesController extends Controller
{
  
    public function get_main_page( )
    {
        $lang = app()->getLocale();
        $page_options["lang"] = $lang;
    

        $main_page = DB::table("page_options")
        ->select("main_page_text_$lang","settings","title_$lang","meta_description_$lang")
        ->get()->first();

        $main_text_ = "main_page_text_$lang";
        $main_page_text = json_decode( $main_page->$main_text_,1)[0];

        $description_title_ = "meta_description_$lang";  
        $description_title = $main_page->$description_title_;

        $main_title_ = "title_$lang";
        $title =  $main_page->$main_title_;

        //category only for main page
        //////////////////////////
            $categroies_raw = DB::table('categories')->orderBy('category_parent')
            ->select("category_id",'category_parent', "category_order_priority", "category_img_url", "category_name_$lang", "category_url_$lang")
            ->get()
            ->map(function ($item) {
                return (array) $item;
            });
            $categroies_done = [];
            foreach ($categroies_raw as $vals) {
                if($vals[ "category_parent"  ] == 0){
                    $categroies_done[$vals["category_id"]] = $vals;
                    $categroies_done[$vals["category_id"]]["name"] = $vals["category_name_$lang"];
                    $categroies_done[$vals["category_id"]]["url"] = $vals["category_url_$lang"];
                }
                else
                {
                    // тільки категорії без батьків
                    if( isset($categroies_done[$vals["category_parent"]] )){
                        
                    $categroies_done[$vals["category_parent"]] ["child"]  [$vals["category_id"]]   =
                    [ "name"  => $vals["category_name_$lang"] ,'url' => $vals["category_url_$lang"]];
                    }
                }
                // if ($count_cats >= 8) break; 
            }
            $categories =  $categroies_done;
        //category end
        //////////////////////////

        $page_options["products"] = ProductsDataController::getProductsPlates();

        return view("main", [
            "title" => $title, 
            'meta_description'=>$description_title,
            "page_options" => $page_options,

            "categories" => $categories,
            "lang_empty_when_ru" => ($lang == "ru" ? "" : "ua"),
            "main_page_text" =>  $main_page_text
        ]);


    }
    
}
