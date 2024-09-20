<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class BasketOperationController extends Controller
{

    //guest operations
    public function GuestAddProduct(Request $request)
    {
        $cart = session()->get('cart', []);

        // Проверяем, есть ли уже такой товар в корзине
        if (!isset($cart[$request->productId])) {
            // Добавляем новый товар в корзину
            $cart[$request->productId] = [
                'Product_id' => $request->input('productId'),
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $product_count = count($cart);
        return response()->json([
            'error' => isset($php_errormsg) ?  $php_errormsg : 0,
            'status' => 'success',
            'cart' => $cart,
            'product_count' => $product_count
        ]);
    }
    public function GuestShowProducts(Request $request)
    {

        $lang = $request->lang;
           
        $cart = session()->get('cart', []);

        if (!isset($cart)) return "0";
        $full_price = 0;
        foreach ($cart as $key => $values) {
            $cart_res[$key] = DB::table('products')->where(["product_id" => $key])->get(["product_name_" . $lang, "product_price_discount", "product_price"])->first();
            $cart_res[$key]->product_img_urls = "images/product/$key" . "_0_small.webp";
            $cart_res[$key]->quantity =  $values["quantity"];

            if ($cart_res[$key]->product_price_discount > 0) {
                $full_price += ($cart_res[$key]->product_price_discount * $cart_res[$key]->quantity);
            } else {
                $full_price += ($cart_res[$key]->product_price * $cart_res[$key]->quantity);
            }
        }

        isset($cart_res) ?:  $cart_res[] = 0;

        return view("product.basket", ["page_options" => $cart_res, "fullprice" => $full_price,'lang' =>"$lang"]);
    }
    public function GuestDeleteProducts(Request $request)
    {
        
        $cart = session()->get('cart', []);
        $id = $request->input('productId');

        // Удаление товара из корзины
        if (isset($cart[$id])) {
            unset($cart[$id]);
        } else {
            return "non exist$id";
        }

        // Сохранение обновленной корзины в сессии

        session()->put("cart", $cart);

        // Возвращаем обновленное состояние корзины
        $product_count = count($cart);
        return response()->json([
            'error' => isset($php_errormsg) ?  $php_errormsg : 0,
            'status' => 'success',
            'cart' => $cart,
            'product_count' => $product_count
        ]);
    }
    public function GuestChangeProducts(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('productId');
        $productChange = $request->input('productChange');

        // Удаление товара из корзины
        if (isset($cart[$id])) {
            if (isset($productChange)) {
                if ($productChange == "+")        $cart[$id]['quantity']++;
                elseif ($productChange == "-")    $cart[$id]['quantity']--;
                elseif ($productChange)   $cart[$id]['quantity'] = intval($productChange);
                else  return "value error " . $productChange;
                if ($cart[$id]['quantity'] == 0) unset($cart[$id]);
            }
        } else {
            return "non exist";
        }

        // Сохранение обновленной корзины в сессии

        session()->put("cart", $cart);
        $product_count = count($cart);
        // Возвращаем обновленное состояние корзины
        return response()->json([
            'error' => isset($php_errormsg) ?  $php_errormsg : 0,
            'status' => 'success',
            'cart' => $cart,
            'product_count' => $product_count
        ]);
    }
    public function GuestProducts(Request $request)
    {
        $cart = session()->get("cart");

        return response()->json([
            'cart' => $cart,
            "yoket" => csrf_token()
        ]);
    }

    public function GuestCountProducts(Request $request)
    {
        $cart = session()->get('cart', []);


        $product_count = count($cart);
        // Возвращаем обновленное состояние корзины
        return response()->json([
            'error' => isset($php_errormsg) ?  $php_errormsg : 0,
            'status' => 'success',
            'product_count' => $product_count
        ]);
    }
}
