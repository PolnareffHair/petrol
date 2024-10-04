<?php

namespace App\Http\Controllers\Admin\editors;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CatProductAdminController extends Controller
{
    
    public function read(Request $request){

        if(!$request->name ) return "Помилка назви форми";
        $name = $request->name;

        if(!$request->pid ) return "Помилка ідентифікатору продукту";
        $id = $request->pid;
        


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

       $cat_0_parent = [];

        foreach (  $cat_exist as $id_C => $value) {
            if( $value["category_parent"] == 0 )
            {
                $cat_0_parent [$id_C][$id_C] = $value;

            }
        }
        $cat_full_list = $cat_0_parent;
        
        $cat_exist_2level  = $cat_exist;
        // Тут додаються "--" та сортуються катгорії батьківська->дочірня
        foreach (   $cat_exist  as $key =>  $cat_exist_item) {
            if($cat_exist_item["category_parent"] != 0 )
            {
                if(isset($cat_full_list[ $cat_exist_item["category_parent"]] ) ){
                    $cat_full_list[$cat_exist_item["category_parent"]] [] = $cat_exist_item;
                    unset(  $cat_exist_2level [$key]); 
                }
            }
            else   unset(  $cat_exist_2level [$key]); 
        }

        $cat_full_list_2lv_added = $cat_full_list;




        foreach ($cat_exist_2level as  $value) {
            
            $parent1lvl = $cat_exist[$value["category_parent"]]["category_parent"] ;
            unset( $cat_full_list_2lv_added[$parent1lvl] );
        }


   

            foreach ( $cat_full_list[$parent1lvl] as $key => $cat) {

                $cat_full_list_2lv_added[$parent1lvl] [] =  $cat;

                foreach ($cat_exist_2level as  $value) {
                    if($cat["id"] == $value["category_parent"]){
                        $value["category_name_ua"] = "-"  . $value["category_name_ua"] ;
                        $cat_full_list_2lv_added[$parent1lvl] [] =  $value;

                    }
                }

            }

   
        return view("admin.edit.cat.edit_get",["selected"=>$cat_in_product,"avalible"=> $cat_full_list_2lv_added,  "id_item"=>$id,"name" => $name  ] );
        
    }
 
    public function delete(Request $request)
    {
        if (!isset($request->pid)) return "Не встановленний идентифікатор продукту";
        $pid = $request->pid;

        if (!isset($request->id)) return "Не встановленний идентифікатор категорії";
        $id = $request->id;

        $here = DB::table('products')->where(["product_id"=>$pid])->pluck("product_main_category_id")->first(); 

        if($here == $id) return "Категорія встановлена як головна, змініть головну категорію щоб видалити її";
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
    public function create(Request $request)
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
