<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;

use Intervention\Image\Decoders\DataUriImageDecoder;

class ImgProductAdminController extends Controller
{
    
    public function get(Request  $Request)
    {

        $id = $Request->product_id; 

        $pstart = $Request->path_start; 
        $pend = $Request->path_end; 

        if($id) $img = json_decode(DB::table("products")->where("product_id", $id)->pluck("product_img_urls")->first()); else return "Помилка идентифікатора";


        return view("admin.components.img.edit", ["id" => $id, "img" => $img, "path" => [$pstart,$pend],]);
    }

    public function delete(Request $request)
    {

        if (!isset($request->id)) return "Не встанвленний идентифікатор продукту";
        $id = $request->id;
        if (!isset($request->img)) return "Не встанвленний идентифікатор зображення";
        $img = $request->img;

        $imgArr = json_decode((string)DB::table("products")->where("product_id", $id)->pluck("product_img_urls")->first(), true);

        if (($key = array_search($img, $imgArr)) !== false) {
            unset($imgArr[$key]);
            DB::table("products")->where("product_id", $id)->update(["product_img_urls" => json_encode($imgArr)]);
        } else {
            return "Зображення не існує";
        }

        $dir = getcwd();

     
        if (file_exists($dir  . "\\images\\product\\$id" . "_" . "$img" . "_small" . ".webp")) {
            unlink($dir  . "\\images\\product\\$id" . "_" . "$img" . "_small" . ".webp");
        } else return "файл $id" . "_" . "$img" . "_small" . ".webp не існує";
        if (file_exists($dir  . "\\images\\product\\$id" . "_" . "$img" . "_midlle" . ".webp")) {
            unlink($dir  . "\\images\\product\\$id" . "_" . "$img" . "_midlle" . ".webp");
        } else return "файл $id" . "_" . "$img" . "_midlle" . ".webp не існує";

        if (file_exists($dir  . "\\images\\product\\$id" . "_" . "$img" . "_big" . ".webp")) {
            unlink($dir  . "\\images\\product\\$id" . "_" . "$img" . "_big" . ".webp");
        } else return "файл $id" . "_" . "$img" . "_big" . ".webp не існує";

        return "Зображення видалено";
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

        $imgArr = json_decode(DB::table("products")->where("product_id", $id)->pluck("product_img_urls")->first(),true);

        if(!empty($imgArr)){
            $imgName = max($imgArr) + 1;
        }
        else  $imgName=0;

        $imgArr[] =$imgName ; 

         // Получаем загруженное изображение
        $file = $request->file;

        // Проверка, что файл был загружен
        if ($file->isValid()) {
            // Преобразование в ресурс файла


            // Преобразование в строку Base64
            $base64Data = base64_encode(file_get_contents($file->getRealPath()));


            // Преобразование в Data URI
            $dataUri = 'data:image/jpeg;base64,' . $base64Data;


            $manager = new ImageManager(new Driver());


            // read image only from data uri or base64 encoded data
            $image = $manager->read($dataUri, DataUriImageDecoder::class);
            $image1 = $manager->read($dataUri, DataUriImageDecoder::class);
            $image2 = $manager->read($dataUri, DataUriImageDecoder::class);

            $image2->pad(700, 700, 'ffffff');
            $image1->pad(400, 400, 'ffffff');
            $image->pad(200, 200,  'ffffff');

            $image->toWebp(100)->save('images/product/'  . $id . '_' .$imgName.'_small.webp');
            $image1->toWebp(100)->save('images/product/' . $id . '_' . $imgName.'_midlle.webp');
            $image2->toWebp(100)->save('images/product/' . $id . '_' . $imgName.'_big.webp');
            DB::table("products")->where("product_id", $id)->update(["product_img_urls" => json_encode($imgArr)]);
            // Вывод изображения (пример)
            return "Успішно додано";
        }

        return $request->product_id;
    }

    public function update(Request $request)
    {   
        $img = $request->img;
        $id = $request->product_id;
        DB::table("products")->where("product_id", $id)->update(["product_img_urls" => json_encode($img)]);
        return "Порядок успішно збережено";
    }
}
