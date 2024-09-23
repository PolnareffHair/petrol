<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $call_out = [
            "phone_number" => $request->pn ?? "-1",
            "product_id" => (intval($request->id)) ?? "-1",
            "created_at" => now(),
            "updated_at" => now(),
            "status" => "Не оброблено"
        ];
        DB::table("ordered_product")->insert($call_out);
        return 0;
    }
}
