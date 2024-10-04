<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Services\FormBuilder;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class AdminProductController extends Controller
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


        $product["product_description_ru"] = json_encode($product["product_description_ru"]); //make js to string
        $product["product_description_ua"] = json_encode($product["product_description_ua"]);


        $form = new FormBuilder($product, $product["product_id"], 'Продукт №' . $product['product_id'] . ' ' . $product["product_name_ua"]);

        $cats =  (array)DB::table('category_to_product')->where(["product_id" => $product["product_id"]])->pluck("category_id")->toArray();

        $cats =  (array)DB::table('categories')->whereIn("category_id", $cats)->select("category_name_ua",  "category_id")
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->category_id => $item->category_name_ua];
            })
            ->toArray();


        $form->AddSelect("product_main_category_id", "Головна категорія товару", $cats);

        $form->setLinks("/admin/uppdate_product", "/admin/delete_product", "/admin/products");

        $form->AddInputText("product_name", "Назва товару h1 ", true, 255, false, false);

        $form->AddInputText("product_article", "Код товару/артикль(необов'язково)", false, 70, novoid: false);

        $form->AddInputNumber("product_price", "Ціна продукту ", false, [0, 900000]);

        $form->addZeroCheckbox("product_price_discount", "Знижка ", "Ціна зі знижкою", [0, 900000]);

        $form->addCheckbox("product_best_seller", "Відображати плашку хіт");

        $form->addCheckbox("product_show_country", "Відображати прапор країни виробника 🏴󠁥󠁳󠁰󠁶󠁿");

        $form->AddInputNumber("product_order_priority", "Пріоритет відображення ↕️", false, [0, 255]);

        $form->AddSelect("product_avalible_state", "Стан на складі", ["Товар відсутній", "Товар на складі", "Під замовлення до 2-х тижнів"]);

        $form->AddInputText("product_title", "Заголовок сторінки (title)", true, 70, false, "product_name");

        $form->AddHtmlEdit("product_description", "Опис товару ");

        $form->AddInputText("product_meta_description", "Мета опис товару(description tag)", true, 1000, false, "product_name");

        $form->AddInputText("product_img_alt", "Альтернативний напис зображення товару", true, 255, false, "product_name");


        $form->AddInputText("product_tags", "Теги перерахувати через кому(використовуються для пошуку)", true, 1000, false, false);

        $form->AddInputText("product_url", "url продукту тільки латиниця без пробілів(має бути унікальним для кожного продукту)", true, 255, "product_name");


        $form->addEditor([
            "view" => "admin.edit.attr.editor",
            "name" =>  '<span class ="svg_attr" >  Атрибути</span>', // 1
            "path_link" => "/admin/product_edit/attr_edit",
            "id_n" => "attr_editor" 
        ]);

        $form->addEditor([
            "view" => "admin.edit.img.editor",
            "name" =>  '<span class ="svg_img" >  Зображення</span>', // 2
            "path_link" => "/admin/product_edit/img",
            "id_n" => "img_editor" 
        ]);

        $form->addEditor([
            "view" => "admin.edit.video.editor",
            "name" => '<span class="svg_video"> Відео</span>',
            "path_link" => "/admin/product_edit/Video",
            "id_n" => "video_editor" 
        ]);

        $form->addEditor([
            "view" => "admin.edit.cat.editor",
            "name" => "<span class='svg_cats'> Категорії</span>",
            "path_link" => "/admin/product_edit/cats_edit",
            "id_n" => "cat_editor" 
        ]);

        $form->addEditor([
            "view" => "admin.edit.related.editor",
            "name" => "<span class='svg_rel'> Рекомендовані товари</span>",
            "path_link" => "/admin/product_edit/rel_edit",
            "id_n" => "related_editor" 
        ]);




        return $form->finish();
    }
    public function uppdate_product(Request $request)
    {

        $result = $request->productchange;
        $id = $result["item_id"];

        unset($result["item_id"]);

        $result["product_article"] = $result["product_article"] ?? "    ";

        // $result["product_url_ru"] = preg_replace('/\s+/', '', $result["product_url_ru"]); //remove spaces from url
        // $result["product_url_ua"] = preg_replace('/\s+/', '', $result["product_url_ua"]); //remove spaces from url


        $result["product_description_ua"] =  htmlspecialchars($result["product_description_ua"]);
        $result["product_description_ru"] =  htmlspecialchars($result["product_description_ru"]);

        if($result["product_url_ru"] ==        $result["product_url_ua"] ) return "⚠ URL не може бути однаоковий, встановіть інший";
        if ((DB::table("products")->where("product_id", '<>', $id)->where("product_url_ru", $result["product_url_ru"])->get()->count() !== 0)) return "⚠ Помилка продукт  з аналогічним url RU     вже існує, встановіть інший";

        if ((DB::table("products")->where("product_id", '<>', $id)->where("product_url_ua", $result["product_url_ua"])->get()->count() !== 0)) return "⚠ Помилка продукт з аналогічним url UA вже існує, встановіть інший";

        DB::table("products")->where("product_id", $id)->update($result);

        return  "Успішно оновлено";
    }

    //add delete related
    public function delete_product(Request $request)
    {
        if ($request->has('product_id')) {

            $id = $request->input('product_id');

            DB::table('attributes_values')->where(["product_id" =>   $id])->delete();

            DB::table('category_to_product')->where(["product_id" =>   $id])->delete();

            DB::table('products')->where('product_id', $id)->delete();


            $dir = getcwd() . '/images/product';  // Исправляем 'ublic' на 'public'
            $files = glob("$dir/{$id}_*");

            // Проверяем, нашлись ли файлы
            if (!$files) {
                return "Файли не знайдені" . $dir;
            }
            foreach ($files as $file) {
                if (!file_exists($file)) {
                    echo "Файл не існує: $file\n";
                } else {
                    unlink($file);
                }
            }
            return 0;
        } else return 'Щось пішло не так';
    }
    //add delete related
    public function duplicate(Request $request)
    {

        if ($request->has('product_id')) {

            $id = $request->input('product_id');

            $new_id =  1 +  DB::table('products')->max('product_id');


            $product = (array) DB::table('products')->where('product_id', $id)->first();

            $product["product_id"] = $new_id;

            $product["product_url_ru"] =  $product["product_url_ru"] . 2;
            $product["product_url_ua"] =  $product["product_url_ua"] . 2;

            $product = (array) DB::table('products')->insert($product);

            $attr = DB::table('attributes_values')->select(["atribute_id", "atribute_name_ua", "atribute_name_ru"])
                ->where(["product_id" => $id])->get()
                ->map(function ($item) use ($new_id) {
                    $item->product_id =   $item->product_id = $new_id;
                    return (array)   $item;
                })->toArray();

            DB::table('attributes_values')->insert($attr);


            $cats = (array)  DB::table('category_to_product')->where(["product_id" =>   $id])
                ->get()->map(function ($item) use ($new_id) {
                    $item->product_id =   $item->product_id = $new_id;
                    return (array)   $item;
                })->toArray();
            DB::table('category_to_product')->insert($cats);



            $dir = getcwd() . '/images/product';  // Исправляем 'ublic' на 'public'
            $files = glob("$dir/{$id}_*");
            $newfile = [];

            foreach ($files  as $key => $val) {
                $newfile[$key][1] = preg_replace('/\d+(?=_)/', $new_id, $val, 1);
                $newfile[$key][0] = $val;

                if (file_exists($val)) {
                    copy($val, preg_replace('/\d+(?=_)/', $new_id, $val, 1));
                }
            }

            return redirect("/admin/product/$new_id");
        } else return 'Щось пішло не так';
    }
}
