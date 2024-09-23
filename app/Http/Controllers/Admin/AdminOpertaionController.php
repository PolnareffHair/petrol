<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\FormBuilder;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class AdminOpertaionController extends Controller
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

        $product["product_video_link"] = rtrim($video_links, ',');


        $product["product_description_ru"] = json_encode($product["product_description_ru"]); //make js to string
        $product["product_description_ua"] = json_encode($product["product_description_ua"]);    
    
        
        $form = new FormBuilder($product,$product["product_id"]); 

        $form->AddInputText(   "product_name","Нзва товару h1 ",true,255,false,false);

        $form->AddInputText( "product_article","Код товару/артикль(необов'язково)",false,70);

        $form->AddInputNumber(     "product_price" , "Ціна продукту" , false, [0, 900000]);

        $form->addZeroCheckbox("product_price_discount","Знижка" ,"Ціна зі знижкою", [0, 900000]);

        $form->addCheckbox("product_best_seller","Відображати плашку хіт");
        
        $form->addCheckbox("product_show_country","Відображати прапор країни виробника");

        $form->AddSelect( "product_avalible_state","Стан на складі",["Товар відсутній", "Товар на складі", "Під замволення до 2-х тижнів"]);

        $form->AddInputText( "product_title","Заголовок сторінки (title)",true,70,false,"product_name");

        $form->AddInputNumber(   "product_order_priority" ,"Пріорітет відображення " , false, [0, 255]);

        $form->AddHtmlEdit("product_description" ,"Опис товару ");

        $form->AddInputText(   "product_meta_description","Мета опис товару(description tag)",true,1000,false,"product_name");

        $form->AddInputNumber(     "product_order_priority", "Пріорітет відображення " , false,[0, 255]);     
      
        $form->AddInputText(  "product_img_alt","Альтернативний напис зображення товару",true,255,false,"product_name");

        $form->AddInputText( "product_video_link" ,"Посилання на відео(вбудоване) через кому. Формат :www.youtube.com/embed/ZzD8OTLK0GIЄ",false,1000,false,false);
        
        $form->AddInputText(   "product_tags","Теги перерахувати через кому(використовуються для пошуку)",true,1000,false,false);

        $form->AddInputText( "product_url","url продукту тільки латиниця без пробілів(має бути унікальним для кожного продуктку)",true,255,"product_name");

        $form->finish();
        

        return view("admin.form_edit", ["product" => $product, "form" => $form]);
    }
    public function uppdate_product(Request $request)
    {

        $result = $request->productchange;
        $id = $result["item_id"];

        unset($result["item_id"]);

        $result["product_article"] = $result["product_article"] ?? "    ";

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

            DB::table('attributes_values')->where( ["product_id"=>   $id])->delete();

            DB::table('category_to_product')->where( ["product_id"=>   $id])->delete();

            DB::table('products')->where('product_id', $id)->delete();
            
            
            $dir = getcwd() . '/images/product';  // Исправляем 'ublic' на 'public'
            $files = glob("$dir/{$id}_*");
            
            // Проверяем, нашлись ли файлы
            if (!$files) {
                return "Файли не знайдені".$dir;
            }
            foreach ($files as $file) {
                if (!file_exists($file)) {
                    echo "Файл не существует: $file\n";
                }
            }
            return 0;
        } else return 'Щось пішло не так';

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
