<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CatProductAdminController extends Controller
{
    
    public function get(Request $request){

        if(!$request->name ) return "Помилка назви форми";
        $name = $request->name;

        if(!$request->id ) return "Помилка ідентифікатору продукту";
        $id = $request->id;

        $cat_exist =  db::table("categories")->select("category_name_ua","category_ID","category_parent")->get()
        ->mapWithKeys(function ($item) {
            return [$item->category_ID => ["category_parent"=>$item->category_parent,"category_name_ua"=>$item->category_name_ua,"id" =>$item->category_ID ]];
        })
        ->toArray();

        
        $cat_in_product =  db::table('category_to_product')->where(["product_id"=>$id])->get("category_id")
        ->map(function ($item) {
            return $item->category_id;
        })->toArray();

    
        $t = function($value) use ($cat_exist) {
            $ar = $cat_exist[$value] ; // Возвращаем null, если ключ не найден
            $ar["id"] = $value ;
            return $ar;
        };  

        // categrory_name_ua, category_id, category_parent
        $cat_in_product = array_map($t, $cat_in_product); 

        $off_parents = [];        
        
        foreach($cat_in_product as $key=>$cat){  
            //take a category parent if exist   
            if($cat["category_parent"] !=0)  $off_parents[$key] = $cat["category_parent"];
            if(  isset($cat_exist[$cat["category_parent"]]["category_parent"] )&& $cat_exist[$cat["category_parent"]]["category_parent"] != 0 ) 
                $off_parents[] = $cat_exist[$cat["category_parent"]]["category_parent"]; 
            $off_parents = array_unique($off_parents);
        }
   
        
        foreach($cat_in_product as $key=>$cat){  

            if(!isset($cat_exist[$cat['id']]))  { Log::error("p:$id Cat duplicated:".$cat['id']); continue;}

            $key = array_search($cat['category_name_ua'], $cat_exist[$cat['id']]);

            if($key === false)   { Log::error("p:$id Cat dont exist:".$cat['id']); continue;}

            $cat_exist[$cat['id']]["disabled"] = 1; 
            //Надає блокування батьківських категорій на 3 ріня 1> [2>[2,1,23], 3>[1,23,12] , 2>[12,3,12]]
            if(isset($cat_exist[$cat['id']]["category_parent"]) && $cat_exist[$cat['id']]["category_parent"] != 0 ){

                if(isset( $cat_exist[$cat_exist[$cat['id']]["category_parent"]]  ["category_parent"])  && 
                    $cat_exist[$cat_exist[$cat['id']]["category_parent"]] ["category_parent"] != 0 )
                {
                        $cat_exist[$cat_exist[$cat_exist[$cat['id']]["category_parent"]] ["category_parent"]]["disabled"] = 1;
                }

                $cat_exist[$cat_exist[$cat['id']]["category_parent"]] ["disabled"] = 1; 
            }            
        }

       // return var_dump($cat_in_product);

       $cat_exist_proceed =  $cat_exist;

       $avalible = [];

        foreach (  $cat_exist_proceed as $id_C => $value) {
            if( $value["category_parent"] == 0 )
            {
                $avalible [$id_C][$id_C] = $value;
            }
        }
        $avalible_chng = $avalible ;


        // Тут додаються "--" та сортуються катгорії батьківська->дочірня
        foreach (   $avalible as $value) {

            foreach (   $value as $id_C => $category) {

                if( $category["category_parent"] != 0 )
                {
                    //add a -- to 3level deep
                    if( isset ( $cat_exist_proceed[$value["category_parent"]] ["category_parent"]) && $cat_exist_proceed[$value["category_parent"]] ["category_parent"]   != 0) 
                    {
                        $value["category_name_ua"] =   "--". $value["category_name_ua"]; 
                        
                        // // Получаем первую часть массива
                        // $firstPart[] = array_slice($avalible[$cat_exist_proceed[$value["category_parent"]] ["category_parent"]]  ,  0, $cat_exist_proceed[$value["category_parent"]] ["category_parent"]+1); 

                        // // Получаем вторую часть массива
                        // $firstPart[] = array_slice($avalible[$cat_exist_proceed[$value["category_parent"]] ["category_parent"]] , $cat_exist_proceed[$value["category_parent"]] ["category_parent"]+1);

                        // $firstPart =  array_merge( $firstPart[0], [$value],$firstPart[1]);

                        $avalible[$cat_exist_proceed[$value["category_parent"]] ["category_parent"]][$id_C] = $value;

                    }   
                    //add a -- to 2level deep
                    else
                    {
                        $value["category_name_ua"] =   "-". $value["category_name_ua"]; 
                        $avalible[$value["category_parent"]][$id_C] = $value;
                    }
                }
            }


        }

        return view("admin.components.cat.edit_get",["selected"=>$cat_in_product,"avalible"=>  $avalible ,  "id_item"=>$id,"name" => $name  ] );
        
    }
    public function update(Request $request)
    {   
        if (!isset($request->id)) return "Не встанвленний идентифікатор продукту";
        $id = $request->id;

        if (!isset($request->attr)) return "Не встанвленний идентифікатор категорії";
        $attr = $request->attr;

        if (!isset($request->attr_val)) return "Не встанвлене значення категорії";
        $attr_val = $request->attr_val;

   
       $attr_name =(array) DB::table("attributes_values_exist")->where("val_name_ua" , $attr_val)->get()[0];

        if (!isset( $attr_name)) return "Не існує значення категорії";

        DB::table("attributes_values")->where("product_id", $id)
        ->where("atribute_id" , $attr)
        ->update([   "atribute_name_ua"=>$attr_name["val_name_ua"],"atribute_name_ru"=>$attr_name["val_name_ru"]]);

        return "Тег успішно оновлено";
    }
    public function delete(Request $request)
    {
        if (!isset($request->pid)) return "Не встановленний идентифікатор продукту";
        $pid = $request->pid;

        if (!isset($request->id)) return "Не встановленний идентифікатор категорії";
        $id = $request->id;

        DB::table("category_to_product")->where("category_id", $id)->where("product_id", $pid)->delete();


        return "Категорію успішно видалено";
    }
    /**
     * img_add
     *          
     * @param  $request [product_id, file(from input form)] 
     * @return Number 0 if opreation successefull  
     * Creates image in floader productid_imgid *_big *_middle  *_small and adds it to current product
     */
    public function add(Request $request)
    {
     
        if (!isset($request->pid)) return "Не встановленний идентифікатор продукту";
        $pid = $request->pid;

        if (!isset($request->id)) return "Не встановленний идентифікатор  категорії";
        $id = $request->id;



        if(DB::table("category_to_product")->where("category_id", $id)->where("product_id", $pid)->get()->count() != 0) return "Категорія вже привязана до товару";

        DB::table("category_to_product")->insert(["category_id"=> $id,"product_id"=> $pid]);
        return "Категорію успішно додано";
        
    }
}
