<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class ProductsDataController extends Controller
{
   

    
    /**
     * getProducts
     *
     * @param  mixed $quantity Кількість позицій
     * @param  mixed $discount
     * @param  mixed $states
     * @return void
     */
    static public function getProducts( $quantity = 10,  $discount = 0 , $states = [2], $skip  = 0)
    {
        $lang = app()->getLocale();
        
    
        //if($discount == 1)  $products->where("product_price_discount", "!=", 1 );


        $products = DB::table('products')->whereIn("product_avalible_state", $states)->take($quantity)->get()->map(function ($item) {
            return (array) $item;
        });

        //hmmmmmmmmmmmmmmmmmmmm
        if (0 != $products->count()) {

        //atributes
        foreach ($products as $value) {
            $product_attr_id[] = $value["product_id"];
        }        

        //Получение названия атрибутов 
        $attributes = DB::table('attributes')
            ->get(["atribute_ID", "atribute_name_$lang"])
            ->mapWithKeys(function ($item) use ($lang) {
                return [
                    $item->atribute_ID => $item->{"atribute_name_$lang"}
                ];
            })
            ->toArray();

        //Получение продукта с атрибутами
        $atributes_values = DB::table('attributes_values')
            ->whereIn('product_id', $product_attr_id)
            ->select('product_id', 'atribute_id', "atribute_name_$lang")
            ->get()
            ->groupBy('product_id')
            ->map(function ($group) use ($lang,  $attributes) {
                return $group->mapWithKeys(function ($item) use ($lang, $attributes) {
                    $attributeId = $item->atribute_id;
                    // Подмена atribute_id на значение из массива $attributeReplacements
                    $key = $attributes[$attributeId] ?? $attributeId;

                    return [$key => $item->{"atribute_name_$lang"}];
                })->toArray();
            })
            ->toArray();


            //attr cut 
        //Малозначащие атрибуты - . тип счетчика 7 . страна 4 . запрещенные вещества  10    . производитель  12. Мощность 11. градация фильтра 9. Рабочая температура 6
        // Аттрибуты убираються для того что бы не переролнять контейнер в карточке товара 
        $take_out_attributes_origin = [7, 4, 10, 12, 11, 9, 6];
        foreach ($take_out_attributes_origin as $valAttri_replace) {
            $take_out_attributes[] = $attributes["$valAttri_replace"];
        }

        $products_compiled = [];
        // Обновление массива $values
        foreach ($products as  $key => &$value) {
            $productId = $value["product_id"];
            // Проверяем, существует ли ключ в $atributes_values
            if (isset($atributes_values[$productId])) {
                if (count($atributes_values[$productId]) > 6) {
                    foreach ($take_out_attributes  as $val) {
                        unset($atributes_values[$productId][$val]);
                        //unset($atributes_values[$productId][$val]);
                        if (count($atributes_values[$productId]) == 6) {
                            break;
                        };
                    }
                }
                if ($value["product_price_discount"] != 0) {
                    $value["discount_uah"] =  $value["product_price"] - $value["product_price_discount"];
                }
                
                $value["attributes"] = $atributes_values[$productId];

                $products_compiled[] = $value;
            } else {
                $value["attribute"] = null; // Или другое значение по умолчанию
            }
        }
        //rating generation
        foreach ($products_compiled as &$valueRat) {
            $ratting = [
                "main_peace" => intval($valueRat["product_rating"]),
                "small_piece" => fmod($valueRat["product_rating"], 1),
                "empty_peace" => intval(5 - $valueRat["product_rating"])
            ];
            $valueRat["product_rating"] =  $ratting;
        }
        return $products_compiled;
        }
        else return [];

    }



    public function get_product($url)
    {
        $value_aut["isAuth"] = Auth::check();
        $value_aut["currentUser"] = Auth::user();

        
        $cart = session()->get('cart', []);

        $lang = app()->getLocale();

        $value_aut["lang"] = $lang;
        


        $values = [];


        $values["lang"] = $lang;
        $values["isAuth"] = Auth::check();
        $values["currentUser"] = Auth::user();



        $product =  (array)DB::table('products')
        ->where("product_url_$lang", $url)
        ->select(
            'product_id',
            'product_show_country',
            'product_order_priority',
            'product_category_id',
            'product_article',
            'product_price',
            'product_video_link',
            "product_img_alt_$lang",
            'product_price_discount',
            'product_best_seller',
            'product_avalible_state',
            'product_rating',
            "product_name_$lang",
            "product_title_$lang",
            "product_url_$lang",
            "product_description_$lang",
            "product_meta_description_$lang",
            "product_tags_$lang",
            'product_img_urls'
        )->first();



        if ($product==null) return "Товар не знайдено : productController";
        $categories = DB::table('categories')->select("category_id", "category_order_priority", "category_img_url", "category_name_$lang", "category_url_$lang", "category_parent")->get();
        $current_category = (array)$categories[$product["product_category_id"]];

        // $categories = [];
        // for ($i = 0; $i < 10; $i++) {
        //     $categories[] =  $current_category;

        //     if ($current_category["category_parent"] == 0) break;
        //     else $current_category = $categories[$current_category["category_parent"]];
        // }


        $product_attr_id[] = $product["product_id"];


        //Получение названия атрибутов 
        $attributes = DB::table('attributes')
            ->get(["atribute_ID", "atribute_name_$lang"])
            ->mapWithKeys(function ($item) use ($lang) {
                return [
                    $item->atribute_ID => $item->{"atribute_name_$lang"}
                ];
            })
            ->toArray();;
        //Получение продукта с атрибутами
        $atributes_values = DB::table('attributes_values')
            ->whereIn('product_id', $product_attr_id)
            ->select('product_id', 'atribute_id', "atribute_name_$lang")
            ->get()
            ->groupBy('product_id')
            ->map(function ($group) use ($lang,  $attributes) {
                return $group->mapWithKeys(function ($item) use ($lang, $attributes) {
                    $attributeId = $item->atribute_id;
                    // Подмена atribute_id на значение из массива $attributeReplacements
                    $key = $attributes[$attributeId] ?? $attributeId;

                    return [$key => $item->{"atribute_name_$lang"}];
                })->toArray();
            })
            ->toArray();


 


        $productId = $product["product_id"];
        // Проверяем, существует ли ключ в $atributes_values
        if (isset($atributes_values[$productId])) {

            $product["attributes"] = $atributes_values[$productId];

            $product_compiled = $product;
        } else {
            $product_compiled = $product;
            $product["attribute"] = null; // Или другое значение по умолчанию
        }

        unset($product); // Очистка ссылки на последний элемент

     
            $ratting = [
                "main_peace" => intval($product_compiled["product_rating"]),
                "small_piece" => fmod($product_compiled["product_rating"], 1),
                "empty_peace" => intval(5 - $product_compiled["product_rating"])
            ];
            $product_compiled["product_rating"] =  $ratting;
        
        $values = $product_compiled;



        return view("product", ["page_options" => $value_aut, "product" => $values,    "compare_counter"=> session()->get('compare_counter')]);
    }

    public function get_category($url, Request $request)
    {
        $tags  =  "";
        $max_price = 10000000;
        $min_price = 0;

        $lang = app()->getLocale();
        //Search category
        $id = DB::table('categories')->where(["category_url_$lang" => "$url"])->pluck("category_id")->first();
        //search products in category
        if (!isset($id)) return "Категорія не знайдена";
        //if discount
        //if multiply tags 

        $products = DB::table('products')
            ->where(["product_category_id" => $id])
            ->where(function ($query) use ($max_price) {
                $query->where("product_price", "<=", $max_price)
                    ->orWhere("product_price_discount", "<=", $max_price);
            })
            ->where(function ($query) use ($min_price) {
                $query->where("product_price", ">=", $min_price)
                    ->orWhere("product_price_discount", ">=", $min_price);
            })
            ->whereIn("product_avalible_state", [1, 2])
            ->pluck("product_id");

        if (!isset($products[0])) return 0;
        //first cut price second atributes show products with atributes liberty count
        $products_quantity =  $products->count();

        $atributes_values = DB::table('attributes_values')->whereIn("product_id", $products, $boolean = 'or')->get(["atribute_name_$lang", "atribute_id", "product_id"])->toArray();

        $atributes = DB::table('attributes')->pluck("atribute_name_$lang", "atribute_ID");

        foreach ($atributes_values as  $std_class) {
            $value = (array)$std_class;
            if (isset($out[$value["atribute_id"]][$atributes[$value["atribute_id"]]][$value["atribute_name_$lang"]])) {
                $out[$value["atribute_id"]][$atributes[$value["atribute_id"]]][$value["atribute_name_$lang"]]++;
            } else {
                $out[$value["atribute_id"]][$atributes[$value["atribute_id"]]][$value["atribute_name_$lang"]] = 1;
            }
        }
        return [$out, "Quantity" => $products_quantity];
        //получить наличные атрибуты
    }
        

  
    /**
     * GetFavoritesProducts
     * Gets favorite products for user
     * @param  mixed (User) $user_aut 
     * @return array
     */
    static public function getFavoriteProducts():array
    {
        $user_aut = Auth::user();
        if (isset($user_aut) ) {
            $user = (array) DB::table("favorites")->where("user_id", $user_aut["id"])->select("product_ids", "user_id")->get()->first();
            if (isset($user["user_id"])) {
               return  json_decode($user["product_ids"]) ?? [];
            }
            else return  [];
        }
        else return  [];
    }       

        
    /**
     * getCompareProducts gets products in compare
     *
     * @return void
     */
    static public function getCompareProducts():array
    {
        $compare = session()->get('compare', []);
        $compare = array_keys($compare);
        return $compare;
    }

    static public function getProductOrder( ){



    }




 
}
