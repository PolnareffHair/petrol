<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function Search(Request $request)
    {
        $search = "a";
        $lang = app()->getLocale();
        $result
            = DB::table('products')
            ->orWhere("product_name_ru", "LIKE", "%{$search}%")
            ->orWhere("product_name_ua", "LIKE", "%{$search}%")
            ->orWhere("product_tags_ua", "LIKE", "%{$search}%")
            ->orWhere("product_tags_ru", "LIKE", "%{$search}%")
            ->get(["product_name_" . $lang]);

        return $result;
    }
}
