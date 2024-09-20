<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\call_me;
use Illuminate\Http\Request;

class Call_Me_Controller extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $call_out = [
            "call_number" => $request->phone_number,
            "call_message" => isset($request->text) ? $request->text : 0,
            "created_at" => now(),
            "updated_at" => now(),
            "status" => "Оброблено"
        ];
        DB::table("calls")->insert($call_out);
        return 0;
    }
}
