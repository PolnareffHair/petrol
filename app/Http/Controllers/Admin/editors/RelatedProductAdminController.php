<?php

namespace App\Http\Controllers\Admin\editors;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;

use Intervention\Image\Decoders\DataUriImageDecoder;

class RelatedProductAdminController extends Controller
{
    
    public function get(Request  $Request)
    {

        $id = $Request->product_id; 

        if($id)
         $related_ids = ((array) DB::table("products")->where("product_id", $id)->select("product_related")->first())["product_related"]  ; else return "Помилка идентифікатора";
   
        $related_ids = json_decode($related_ids,true);
        $imgs =  [];

            $imgs =  DB::table("products")->whereIn("product_id", $related_ids )->pluck("product_img_urls" ,"product_id")->toArray();
            
            $imgs =    array_map(function($item){ return json_decode($item)[0];  }, $imgs);

            $names =  DB::table("products")->whereIn("product_id", $related_ids )->pluck("product_name_ua","product_id")->toArray();
        
    
  

        return view("admin.product_edit.related.edit_get", ["id_item" => $id, "related_ids" =>$related_ids,"imgs" => $imgs,"names"=>$names] );
    }

    public function delete(Request $request)
    {

        if (!isset($request->id)) return "Не встанвленний идентифікатор продукту";
        $id = $request->id;
        if (!isset($request->related)) return "Не встанвленний идентифікатор зображення";
        $related = $request->related;

        $relatedArr = json_decode((string)DB::table("products")->where("product_id", $id)->pluck("product_related")->first(), true);

        if (($key = array_search($related, $relatedArr)) !== false) {
            unset($relatedArr[$key]);
            DB::table("products")->where("product_id", $id)->update(["product_related" => json_encode($relatedArr)]);
        } else {
            return "Продукт зв'язку не існує";
        }

        return "Продукт зв'язку  видалено";
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
        
        $id = $request->product_id ;

        $related_id = $request->related_id;

        if(!$related_id || !$id ) return "Немає значення";

        $imgArr = json_decode(DB::table("products")->where("product_id", $id)->pluck("product_related")->first(),true);

   

   
        if(!$imgArr)  
        {
            $imgArr =  [];
            $imgArr [] =  $related_id;
            DB::table("products")->where("product_id", $id)->update(["product_related" => json_encode($imgArr)]);

            return "Успішно додано";
        }

        if( in_array( $related_id ,$imgArr))  return    abort(409);
        

        $imgArr[] =  $related_id ;   
        
        DB::table("products")->where("product_id", $id)->update(["product_related" => json_encode($imgArr)]);

        return "Успішно додано";

    }

    public function update(Request $request)
    {   

        $img = $request->img;

        $id = $request->product_id;

        DB::table("products")->where("product_id", $id)->update(["product_related" => json_encode($img)]);

        return "Порядок успішно збережено";
    }
}
