<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;

class MainController extends Controller
{


    public function dashboard()
    {
        $values = [];
        $values["lang"] = app()->getLocale();

        $values["isAuth"] = Auth::check();
        $values["currentUser"] = Auth::user();


        if (! $values["isAuth"] = Auth::check()) {
            return  redirect('/');
        }

        return view("dashboards", ["page_options" => $values,"compare_counter"=> session()->get('compare_counter')]);
    }
}
