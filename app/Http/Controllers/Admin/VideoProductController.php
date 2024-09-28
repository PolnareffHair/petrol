<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;

use Intervention\Image\Decoders\DataUriImageDecoder;

class VideoProductController extends Controller
{
    
    public function get(Request  $Request)
    {

        $id = $Request->product_id; 


        if($id) $video = json_decode(DB::table("products")->where("product_id", $id)->pluck("product_video_link")->first()); else return "Помилка идентифікатора";

        return view("admin.components.video.edit", ["id" => $id, "id_item" => $id,"video"=>$video ]);
    }

    public function delete(Request $request)
    {

        if (!isset($request->id)) return "Не встанвленний идентифікатор продукту";
        $id = $request->id;
        if (!isset($request->video)) return "Не встанвленний идентифікатор Відео";
        $video = $request->video;

        $videoArr = json_decode((string)DB::table("products")->where("product_id", $id)->pluck("product_video_link")->first(), true);

        if (($key = array_search($video, $videoArr)) !== false) {
            unset($videoArr[$key]);
        } else {
            return "Відео не існує";
        }

        DB::table("products")->where("product_id", $id)->update(["product_video_link" => json_encode($videoArr)]);
        return "Відео видалено";
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
    
        $id = $request->product_id;
        $arr = json_decode(DB::table("products")->where("product_id", $id)->pluck("product_video_link")->first(),true);
            filter_var("asdas");
            if(!str_starts_with($request->link,"www.youtube.com/embed/")) return "Помилка в посиланні $request->link";

            if(in_array( $request->link, $arr))  return "Посилання вже існує";

            if( isset($request->link)){ 
                    $arr[] = $request->link;
            }  
            else return  $request->link;

            //$arr = array_filter( $arr );



            $imgArr = json_encode( $arr ,   JSON_UNESCAPED_SLASHES);
            DB::table("products")->where("product_id", $id)->update(["product_video_link" => $imgArr]);
        // Вывод изображения (пример)
 
        return "Успішно додано";
    }

    public function update(Request $request)
    {   
        $img = $request->img;
        $id = $request->product_id;
        DB::table("products")->where("product_id", $id)->update(["product_video_link" => json_encode($img)]);
        return "Порядок успішно збережено";
    }
}
