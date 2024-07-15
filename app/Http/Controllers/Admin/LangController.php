<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function change($lang)
    {
        \Session::put('lang',$lang);
        return back();
    }
}
