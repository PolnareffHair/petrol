<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;

use Intervention\Image\Decoders\DataUriImageDecoder;

class TagProductAdminController extends Controller
{
    public function get($id)
    {
        $attr_names =  db::table("attributes")->pluck(   "atribute_name_ua","atribute_ID")
        ->map(function ($item) {
            return  $item;
        })
        ->toArray();

        $attr_exist =  db::table("attributes_values_exist")->get()
        ->map(function ($item) {
            return (array) $item;
        })
        ->toArray();
        
        $attr_in_product =  db::table("attributes_values")->where(["product_id"=>$id])->get(["atribute_id","atribute_name_ua"])
        ->map(function ($item) {
            return (array) $item;
        })->toArray();

        //existing arrtibutes with values
        $attr_ex = [];

        $selected = [];

        foreach ($attr_exist as $attr)
        {
            $attr_ex[$attr["attr_id"]][] = $attr['val_name_ua'];
        }

        $selected =  $attr_ex;

        $selected_done =[];     
    
        foreach($attr_in_product as $attr_s){  
           
            $key = array_search($attr_s['atribute_name_ua'],$attr_ex[$attr_s['atribute_id']]);
            if($key === false) return "unfind";

            $sel_attr = $selected[$attr_s['atribute_id']][$key];

            unset( $selected[$attr_s['atribute_id']][$key]);
            unset(  $attr_ex[$attr_s['atribute_id']]);
          
            array_unshift($selected[$attr_s['atribute_id']],$sel_attr );

            $selected_done[$attr_s['atribute_id']] = $selected[$attr_s['atribute_id']];
        }

        return view("admin.components.tags_editor",["selected"=>$selected_done, "attr_names"=> $attr_names,"avalible"=>$attr_ex,"id_item"=>$id ] );
    }

    public function get_tags(Request $request){
        
        if(!$request->name ) return "Помилка назви форми";
        $name = $request->name;

        if(!$request->id ) return "Помилка ідентифікатору продукту";
        $id = $request->id;

        $attr_names =  db::table("attributes")->pluck(   "atribute_name_ua","atribute_ID")
        ->map(function ($item) {
            return  $item;
        })
        ->toArray();

        $attr_exist =  db::table("attributes_values_exist")->get()
        ->map(function ($item) {
            return (array) $item;
        })
        ->toArray();
        
        $attr_in_product =  db::table("attributes_values")->where(["product_id"=>$id])->get(["atribute_id","atribute_name_ua"])
        ->map(function ($item) {
            return (array) $item;
        })->toArray();

        //existing arrtibutes with values
        $attr_ex = [];

        $selected = [];

        foreach ($attr_exist as $attr)
        {
            $attr_ex[$attr["attr_id"]][] = $attr['val_name_ua'];
        }

        $selected =  $attr_ex;

        $selected_done =[];     
    
        foreach($attr_in_product as $attr_s){  

      
           
            $key = array_search($attr_s['atribute_name_ua'],$attr_ex[$attr_s['atribute_id']]);
            if($key === false) return "unfind";

            $sel_attr = $selected[$attr_s['atribute_id']][$key];

            unset( $selected[$attr_s['atribute_id']][$key]);
            unset(  $attr_ex[$attr_s['atribute_id']]);
          
            array_unshift($selected[$attr_s['atribute_id']],$sel_attr );

            $selected_done[$attr_s['atribute_id']] = $selected[$attr_s['atribute_id']];
        }

        return view("admin.components.tags_edit_get",["selected"=>$selected_done, "attr_names"=> $attr_names,"avalible"=>$attr_ex,  "id_item"=>$id,"name" => $name  ] );
        
    }

    public function update(Request $request)
    {   
   
        if (!isset($request->id)) return "Не встанвленний идентифікатор продукту";
        $id = $request->id;

        if (!isset($request->attr)) return "Не встанвленний идентифікатор атрибуту";
        $attr = $request->attr;

        if (!isset($request->attr_val)) return "Не встанвлене значення атрибуту";
        $attr_val = $request->attr_val;

   
       $attr_name =(array) DB::table("attributes_values_exist")->where("val_name_ua" , $attr_val)->get()[0];

        if (!isset( $attr_name)) return "Не існує значення атрибуту";

        DB::table("attributes_values")->where("product_id", $id)
        ->where("atribute_id" , $attr)
        ->update([   "atribute_name_ua"=>$attr_name["val_name_ua"],"atribute_name_ru"=>$attr_name["val_name_ru"]]);

        return "Тег успішно оновлено";
    }


    public function delete(Request $request)
    {

        if (!isset($request->id)) return "Не встанвленний идентифікатор продукту";
        $id = $request->id;
        if (!isset($request->attr)) return "Не встанвленний идентифікатор атрибуту";
        $attr = $request->attr;


        DB::table("attributes_values")->where("product_id", $id)->where("atribute_id" , $attr)->delete();

        return "Атрибут видалено";
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
     
        if (!isset($request->pid)) return "Не встанвленний идентифікатор продукту";
        $pid = $request->pid;
        if (!isset($request->id)) return "Не встанвленний идентифікатор  атрибуту";
        $id = $request->id;
        if (!isset($request->name)) return "Не встанвленний назву занчення атрибуту";
        $name_ua = $request->name;      

        $name_ru = DB::table("attributes_values_exist")->where("val_name_ua", $name_ua)->where("attr_id", $id)->get("val_name_ru");

        if (!$name_ru) return "Не знайдено назву атрибуту в переліку";

        DB::table("attributes_values")->insert(["atribute_name_ua"=>$name_ua,"atribute_name_ru"=>$name_ru,"product_id"=>$pid,"atribute_id"=>$id]);
    
      
        return "Атрибут успішно додано";
    }
}
