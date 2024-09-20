<?php

namespace App\Http\Controllers;

use Faker\Core\Number;
use Hamcrest\Arrays\IsArray;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Decoders\DataUriImageDecoder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\VarExporter\Internal\Values;

class AdminController extends Controller
{
    public function index()
    {

        $page_text_ua = json_decode(DB::table("page_options")->where("Name", "Main_page_text_ua")->first()->Settings);
        $page_text_ru = json_decode(DB::table("page_options")->where("Name", "Main_page_text_ru")->first()->Settings);

        return view("admin.index", ["page_text_ua" => $page_text_ua, "page_text_ru" => $page_text_ru]);
    }
    public function uppdate_main_page_text(Request $request)
    {
        DB::table("page_options")->where("Name", "Main_page_text_ru")->update(["Settings" =>  $request->textRU]);
        DB::table("page_options")->where("Name", "Main_page_text_ua")->update(["Settings" =>  $request->textUA]);
        return 0;
    }
    public function product($id)
    {       
        $product =  (array)DB::table('products')
            ->where('product_id', $id)
            ->get()
            ->first();

        if ($product == null) return "Товар не знайдено";
        //make js video links to string
        $product["product_video_link"] = json_decode($product["product_video_link"]);
        /* making separeted links from array */
        $video_links = "";
        if (isset($product["product_video_link"])) {
            foreach ($product["product_video_link"] as $value) {
                $video_links .= $value . ',';
            }
        }
  


        //return ($this->getAttrVals());
        
        
        //$atrributes_names_values[$value["attr_id"]] ["options"] [] = $value;
        $product["product_video_link"] = rtrim($video_links, ',');






        $product["product_description_ru"] = json_encode($product["product_description_ru"]); //make js to string
        $product["product_description_ua"] = json_encode($product["product_description_ua"]);



        //массив параметров для отображения формы
        $form_parameters = [
            "product_name" => [
                "type" => "input_",
                "lang" => 1,
                "val_type" => "text",
                "lenght_limit" => 255,
                "title" => "Нзва товару h1 "
            ],
            "product_title" => [
                "type" => "input_",
                "lang" => 1,
                "val_type" => "text",
                "lenght_limit" => 70,
                "title" => "Заголовок сторінки (title) ",
                "copy_name" => 1
            ],
            "product_show_country" => [
                "type" => "checkbox",
                "val_type" => "checkbox",
                "title" => "Відображати прапор країни виробника",

            ],
            "product_best_seller" => [
                "type" => "checkbox",
                "val_type" => "checkbox",
                "title" => "Відображати плашку хіт",

            ],

            "product_price" => [
                "type" => "input_",
                "lang" => 0,
                "val_type" => "number",
                "number_limit" => [0, 900000],
                "title" => "Ціна продукту"
            ],
            "product_price_discount" => [
                "type" => "zero_checkbox",
                "title" => "Знижка",
                "input_title" => "Ціна зі знижкою",
            ],
            "product_article" => [
                "type" => "input_",
                "lang" => 0,
                "val_type" => "text",
                "lenght_limit" => 255,
                "val_type" => "text",
                "title" => "Код товару/артикль(необов'язково)"
            ],
            "product_video_link" => [
                "type" => "input_",
                "lang" => 0,
                "val_type" => "text",

                "title" => "Посилання на відео(вбудоване) через кому. Формат :
            www.youtube.com/embed/ZzD8OTLK0GIЄ"
            ],
            "product_img_alt" => [
                "type" => "input_",
                "lang" => 1,
                "val_type" => "text",
                "lenght_limit" => 255,
                "title" => "Альтернативний напис зображення товару",
                "copy_name" => 1
            ],
            "product_order_priority" => [
                "type" => "input_",
                "lang" => 0,
                "val_type" => "number",
                "number_limit" => [0, 255],
                "title" => "Пріорітет відображення "
            ],
            "product_tags" => [
                "type" => "input_",
                "lang" => 1,
                "val_type" => "text",

                "title" => "Теги перерахувати через кому(використовуються для пошуку) "
            ],
            "product_description" => [
                "type" => "html_editor",
                "lang" => 1,
                "title" => "Опис товару ",
            ],
            "product_meta_description" => [
                "type" => "input_",
                "val_type" => "text",
                "lang" => 1,
                "title" => "Мета опис товару(description tag) ",
            ],
            "product_avalible_state" => [
                "type" => "options",
                "title" => "Стан на складі",
                "options" => ["Товар відсутній", "Товар на складі", "Під замволення до 2-х тижнів"]
            ],

            
            "product_url" => [
                "type" => "input_",
                "lang" => 1,
                "val_type" => "text",
                "lenght_limit" => 255,
                "title" => "url продукту тільки латиниця без пробілів(має бути унікальним для кожного продуктку)",
                "copy_name_trans" => 1
            ],

        ];


        return view("admin.form_edit", ["product" => $product, "form_object" => $form_parameters]);
    }
    public function uppdate_product(Request $request)
    {

        $result = $request->productchange;
        $id = $result["product_id"];
        unset($result["product_id"]);

        $result["product_article"] = $result["product_article"];

        $result["product_url_ru"] = preg_replace('/\s+/', '', $result["product_url_ru"]); //remove spaces from url
        $result["product_url_ua"] = preg_replace('/\s+/', '', $result["product_url_ua"]); //remove spaces from url


        $result["product_video_link"] = json_encode(explode(",", $result["product_video_link"]));

        $result["product_description_ua"] =  htmlspecialchars($result["product_description_ua"]);
        $result["product_description_ru"] =  htmlspecialchars($result["product_description_ru"]);

        if ((DB::table("products")->where("product_id", '<>', $id)->where("product_url_ru", $result["product_url_ru"])->get()->count() !== 0)) return "Помилка запис з аналогічним url ru вже існує";

        if ((DB::table("products")->where("product_id", '<>', $id)->where("product_url_ua", $result["product_url_ua"])->get()->count() !== 0)) return "Помилка запис з аналогічним url ua вже існує";

        DB::table("products")->where("product_id", $id)->update($result);

        return   $result;
    }
    public function delete_product(Request $request)
    {

        if ($request->has('product_id')) {
            $id = $request->input('product_id');
            if (DB::table('products')->where('product_id', $id)->delete() > 0) {
                return "Продукт успішно видалено";
            } else return 'Щось пішло не так';
        }
    }

    public function get_img($id)
    {
        $img = json_decode(DB::table("products")->where("product_id", $id)->pluck("product_img_urls")->first());

        return view("admin.img_edit", ["id" => $id, "img" => $img]);
    }
    public function img_update(Request $request)
    {
        $img = $request->img;
        $id = $request->product_id;

        DB::table("products")->where("product_id", $id)->update(["product_img_urls" => json_encode($img)]);
        return "Порядок успішно збережено";
    }
    public function img_delete(Request $request)
    {

        if (!isset($request->id)) return "Не встанвленний идентифікатор продукту";
        $id = $request->id;
        if (!isset($request->img)) return "Не встанвленний идентифікатор зображення";
        $img = $request->img;

        $imgArr = json_decode((string)DB::table("products")->where("product_id", $id)->pluck("product_img_urls")->first(), true);

        if (($key = array_search($img, $imgArr)) !== false) {
            unset($imgArr[$key]);
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


        DB::table("products")->where("product_id", $id)->update(["product_img_urls" => json_encode($imgArr)]);

        return "Зображення видалено";
    }
    
    /**
     * img_add
     *          
     * @param  $request [product_id, file(from input form)] 
     * @return Number 0 if opreation successefull  
     * Creates image in floader productid_imgid *_big *_middle  *_small and adds it to current product
     */
    public function img_add(Request $request):Number
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
            return 0;
        }

        return $request->product_id;
    }


    
    /** 
     * getAttrVals
     *
     * @return array $atrributes [$id] [ atribute_name_ua, atribute_name_ru, options[val_id, val_name_ru,val_name_ua] ]
     */
    private function getAttrVals():array
    {
        $attributes =  DB::table('attributes')->get( ["atribute_ID", "atribute_name_ua","atribute_name_ru"])->mapWithKeys(function ($item) {
            return [$item->atribute_ID => [
                'atribute_name_ua' => $item->atribute_name_ua,
                'atribute_name_ru' => $item->atribute_name_ru
            ]];
        })->toArray();
         
        $attributes_values =  (array)DB::table('attributes_values_exist')->get()->map(function($item) {
            return (array) $item;
        })->toArray();

        $atrributes_names_values = $attributes;

        foreach($attributes_values as $key=> $value)
        {
           $temp = $value;
           unset($temp ["attr_id"]);
            $atrributes_names_values[$value["attr_id"]] ["options"] [] = $temp; 
        }
        return  $atrributes_names_values ;


    }
}
