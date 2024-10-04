<?php

namespace App\Http\Controllers\Admin\editors;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;

use Intervention\Image\Decoders\DataUriImageDecoder;

use function PHPUnit\Framework\returnSelf;

class RelatedProductAdminController extends Controller
{
    public function searchProducts(Request $request)
    {
        $search = $request->search ?? "_";
        $full_info = $request->info ?? false;
    
        $products = DB::table('products')
            ->where(function ($query) use ($search) {
                $query->where("product_name_ua", 'like', "%$search%")
                    ->orWhere("product_name_ru", 'like', "%$search%")
                    ->orWhere("product_id", 'like', "%$search%");
            });
        if($request->except) $products->whereNotIn("product_id", $request->except);
        $products = $products->select(["product_id", "product_name_ua", "product_img_urls"])
            ->take(20)
            ->get()
            ->toArray();
    
        return view("admin.edit.related.product_search", ["products" => $products, "search" => $search]);
    }
    
    public function read(Request  $Request)
    {
        if(! $Request->product_id) return "Відсутній ідентифікатор продукту";
        $id = $Request->product_id; 

        if($id)
         $related_ids = ((array) DB::table("products")->where("product_id", $id)->select("product_related")->first())["product_related"]  ; else return "Помилка идентифікатора";
   
        $related_ids = json_decode($related_ids,true);
        if(!empty($related_ids))
        {
        
            $imgs =  [];

            $imgs =  DB::table("products")->whereIn("product_id", $related_ids )->pluck("product_img_urls" ,"product_id")->toArray();
                
            $imgs =    array_map(function($item){ return json_decode($item)[0];  }, $imgs);

            $names =  DB::table("products")->whereIn("product_id", $related_ids )->pluck("product_name_ua","product_id")->toArray();
        }
        else{
            $imgs = [];
            $names = [];
        }

        return view("admin.edit.related.edit_get", ["id_item" => $id, "related_ids" =>$related_ids,"imgs" => $imgs,"names"=>$names] );
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

   
        if( is_array($imgArr)&& count($imgArr) == 5) return "Не більше 5-ти елементів";
   
        if(!$imgArr)  
        {
            $imgArr =  [];
            $imgArr [] =  $related_id;
            DB::table("products")->where("product_id", $id)->update(["product_related" => json_encode($imgArr)]);

            return "Успішно додано";
        }

        if( in_array( $related_id ,$imgArr))   return "Продукт вже в списку";
        

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
