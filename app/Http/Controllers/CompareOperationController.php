<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class CompareOperationController extends Controller
{

    //add to compare
    public function GuestAddCompare(Request $request)
    {

        $compare_counter  = session()->get('compare_counter');
        $compare = session()->get('compare', []);
        $id = $request->input('compare_id');
        $compare_counter == 0 ?   $compare_counter = 1 : $compare_counter++;


        $compare = session()->get('compare', []);
        if (!isset($request->compare_id)) return "empty compare_id";

        // Проверяем, есть ли уже такой товар в сравнении
        if (!isset($compare[$request->compare_id])) {
            // Добавляем новый товар в  сравнении
            $compare[$request->compare_id] = [
                'compare_id' => $request->input('compare_id'),
            ];
        }

        session()->put('compare', $compare);
        session()->put('compare_counter',   $compare_counter);
        return response()->json([
            'error' => isset($php_errormsg) ?  $php_errormsg : 0,
            'status' => 'success',
            'compare' => $compare,
            'compare_counter' => $compare_counter
        ]);
    }
    //delete compare product
    public function GuestRemoveCompare(Request $request)
    {
        $compare_counter  = session()->get('compare_counter');
        $compare = session()->get('compare', []);
        $id = $request->input('compare_id');

        $compare_counter--;

        // Удаление товара 
        if (isset($compare[$id])) {
            unset($compare[$id]);
        } else {
            return "non exist $id";
        }
        // Сохранение  в сессии
        session()->put("compare", $compare);
        session()->put('compare_counter',   $compare_counter);

        return response()->json([
            'error' => isset($php_errormsg) ?  $php_errormsg : 0,
            'status' => 'success',
            'compare' => $compare, 
            'compare_counter' => $compare_counter
        ]);
    
    }

    //Show compare
    public function GuestShowCompare(Request $request)
    {
        $lang = $request->lang;

 
        $attr_lang = "atribute_name_$lang";
        $compare = session()->get('compare');
        if(!isset($compare))    $compare =[]; 
        $pids = $compare;
        $out = [];
         $atributes_values = DB::table('attributes_values')

        ->whereIn("product_id", $compare, $boolean = 'or')
        
        ->get(["atribute_name_$lang","atribute_id", "product_id"])->toArray();

        $atributes_values_products = DB::table('attributes_values')

        ->whereIn("product_id", $compare, $boolean = 'or')
        
        ->get(["atribute_name_$lang","atribute_id", "product_id"]) 
        
        
         ->toArray();


        $atributes = DB::table('attributes')->pluck("atribute_name_$lang", "atribute_ID");

        foreach ($atributes_values as  $std_class) {
            $value = (array)$std_class;
            if (!isset($out[$value["atribute_id"]][$atributes[$value["atribute_id"]]])) {
                $out[$value["atribute_id"]] = $atributes[$value["atribute_id"]];
            }   
        }
       
        $compare = array_keys($compare);

        if (!isset($compare)) return "0";
        $compare_items = [];
        ksort($out);

        $compare_items[0] = $out;

        $name = "product_name_$lang";

        $product_name_img = DB::table('products')
        ->whereIn("product_id", $pids, $boolean = 'or')
        ->get(["product_name_$lang","product_img_urls", "product_id","product_url_$lang"])

        ->mapWithKeys(function($item) use ($name, $lang) {
            $url  = "product_url_$lang";
            return [ $item->product_id=> [
                "name" => $item->$name,
                "url" => $item->$url,
                "img_url" =>   "/images/product/".   $item->product_id ."_". json_decode($item->product_img_urls)[0] . "_small.webp"
            ]];
        })->toArray();




        foreach ($compare as $product_id) 
        {
            $compare_items[$product_id] = [];
            $compare_items[$product_id]["info"] =    $product_name_img[$product_id] ;
            
            foreach($out as  $id =>$item)
            {
                $attr =  array_filter($atributes_values_products, function($item) use ($id,$product_id){
                    return     $item->atribute_id == $id &  $item->product_id ==$product_id;
                });             
                if(isset($attr))   $attr  =  reset($attr ) ;

                if( $attr == false) $attr = "-"   ;

                else  $attr =$attr-> $attr_lang;

                $compare_items[$product_id][$id] =$attr;
       
            }
        }

      //  return var_dump($compare_items);

        return view("common.compare",["compare"=>$compare_items,"lang"=>$lang] ) ;
    }


    public function GuestClearCompare()
    {
        session()->put("compare", []);
        session()->put('compare_counter',   0);

        return response()->json([
            'error' => isset($php_errormsg) ?  $php_errormsg : 0,
            'status' => 'success',
            'compare' => [], 
            'compare_counter' => 0
        ]);
    }
   
}